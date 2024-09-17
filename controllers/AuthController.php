<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use Model\Profesores;
use Model\Vigilantes;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Buscar en las tres tablas
            $usuario = Usuario::where('email', $email);
            $profesor = Profesores::where('email', $email);
            $vigilante = Vigilantes::where('email', $email);  

            if (!$usuario && !$profesor && !$vigilante) {
                $alertas['error'][] = 'Usuario no existe.';
            } else {
                $login_success = false;
                $tipo_usuario = null;

                // Verificar la contraseña para cada tipo de usuario
                if ($usuario && password_verify($password, $usuario->password)) {
                    $login_success = true;
                    $tipo_usuario = 'admin'; // Es un administrador
                } elseif ($profesor && password_verify($password, $profesor->password)) {
                    $login_success = true;
                    $tipo_usuario = 'profe'; // Es un profesor
                } elseif ($vigilante && password_verify($password, $vigilante->password)) {
                    $login_success = true;
                    $tipo_usuario = 'vigilante'; // Es un vigilante
                } else {
                    $alertas['error'][] = 'Contraseña incorrecta.';
                }

                if ($login_success) {
                    // Iniciar sesión y redireccionar según el tipo de usuario
                    session_start();

                    if ($tipo_usuario === 'admin') {
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        header('Location: /admin/dashboard'); // Redireccionar al dashboard de administradores
                    } elseif ($tipo_usuario === 'profe') {
                        $_SESSION['id'] = $profesor->id;
                        $_SESSION['nombre'] = $profesor->nombre;
                        $_SESSION['apellido'] = $profesor->apellido;
                        $_SESSION['email'] = $profesor->correo;
                        header('Location: /profe/dashboard'); // Redireccionar al dashboard de profesores
                    } elseif ($tipo_usuario === 'vigilante') {
                        $_SESSION['id'] = $vigilante->id;
                        $_SESSION['nombre'] = $vigilante->nombre;
                        $_SESSION['apellido'] = $vigilante->apellido;
                        $_SESSION['email'] = $vigilante->email;
                        header('Location: /vigilante/dashboard'); // Redireccionar al dashboard de vigilante
                    }
                }
            }
        }

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            session_destroy();
            header('Location: /');
        }
    }

    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_cuenta();

            if (empty($alertas)) {
                // Verificar si el usuario ya existe
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario) {
                    $alertas['error'][] = 'El Usuario ya está registrado.';
                } else {
                    $usuario->hashPassword();
                    $usuario->crearToken();

                    $usuario->guardar();

                    $emailObj = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $emailObj->enviarConfirmacion();

                    header('Location: /mensaje'); // Redirección al enviar
                }
            }
        }

        $router->render('auth/registro', [
            'titulo' => 'Crear Cuenta',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function olvide(Router $router) {
        $alertas = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
    
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alertas['error'][] = 'Correo electrónico inválido.';
            } else {
                // Buscar usuario y profesor por el correo electrónico proporcionado
                $usuario = Usuario::where('email', $email);
                $profesor = Profesores::where('email', $email);
                $vigilante = Vigilantes::where('email', $email);

    
                if ($usuario && $usuario->confirmado) {
                    // Usuario encontrado y confirmado
                    $usuario->crearToken();
                    $usuario->guardar();
    
                    $emailObj = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $emailObj->enviarInstrucciones();
    
                    $alertas['exito'][] = 'Hemos enviado las instrucciones para restablecer tu contraseña a tu correo.';
                } elseif ($profesor && $profesor->confirmado) {
                    // Profesor encontrado y confirmado
                    $profesor->crearToken();
                    $profesor->guardar();
    
                    $emailObj = new Email($profesor->email, $profesor->nombre, $profesor->token);
                    $emailObj->enviarInstrucciones();
    
                    $alertas['exito'][] = 'Hemos enviado las instrucciones para restablecer tu contraseña a tu correo.';
                } elseif ($vigilante && $vigilante->confirmado) {
                    // vigilante encontrado y confirmado
                    $vigilante->crearToken();
                    $vigilante->guardar();
    
                    $emailObj = new Email($vigilante->email, $vigilante->nombre, $vigilante->token);
                    $emailObj->enviarInstrucciones();
    
                    $alertas['exito'][] = 'Hemos enviado las instrucciones para restablecer tu contraseña a tu correo.';
                } else {
                    $alertas['error'][] = 'El Usuario/Profesor no existe o no está confirmado.';
                }
            }
        }
    
        $router->render('auth/olvide', [
            'titulo' => 'Olvidé mi Contraseña',
            'alertas' => $alertas
        ]);
    }
    

    public static function reestablecer(Router $router) {
        $alertas = [];

        // Obtener el token de la URL
        $token = s($_GET['token']);
        if (!$token) {
            header('Location: /');
            return;
        }

        // Buscar el token en todas las tablas
        $usuario = Usuario::where('token', $token);
        $profesor = Profesores::where('token', $token);
        $vigilante = Vigilantes::where('token', $token);

        $token_valido = !empty($usuario) || !empty($profesor) || !empty($vigilante);

        if (!$token_valido) {
            Usuario::setAlerta('error', 'Token no válido, intenta de nuevo.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Determinar el objeto para restablecer la contraseña
            $objeto = $usuario ?? $profesor ?? $vigilante;

            if ($objeto) {
                // Sincronizar el nuevo password con el objeto
                $objeto->sincronizar($_POST);

                // Validar el password
                $alertas = $objeto->validarPassword();

                if (empty($alertas)) {
                    // Hashear el nuevo password
                    $objeto->hashPassword();

                    // Eliminar el token
                    $objeto->token = null;

                    // Guardar el objeto en la base de datos
                    $resultado = $objeto->guardar();

                    // Redireccionar al login si se guardó con éxito
                    if ($resultado) {
                        header('Location: /login');
                    }
                }
            }
        }

        // Mostrar la vista con las alertas
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Contraseña',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    public static function confirmar(Router $router) {
        $alertas = [];

        $token = $_GET['token'] ?? null;

        if (!$token) {
            header('Location: /');
            return;
        }

        // Buscar usuario, profesor o vigilante por token
        $usuario = Usuario::where('token', $token);
        $profesor = Profesores::where('token', $token);
        $vigilante = Vigilantes::where('token', $token);

        if ($usuario) {
            $usuario->confirmado = true;
            $usuario->token = '';
            $usuario->guardar();
            $alertas['exito'][] = 'Cuenta confirmada exitosamente.';
        } elseif ($profesor) {
            $profesor->confirmado = true;
            $profesor->token = '';
            $profesor->guardar();
            $alertas['exito'][] = 'Cuenta confirmada exitosamente.';
        } elseif ($vigilante) {
            $vigilante->confirmado = true;
            $vigilante->token = '';
            $vigilante->guardar();
            $alertas['exito'][] = 'Cuenta confirmada exitosamente.';
        } else {
            $alertas['error'][] = 'Token inválido.';
        }

        // Mostrar la vista con las alertas
        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar Cuenta',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }
}

