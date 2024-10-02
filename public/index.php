<?php 
 
require_once __DIR__ . '/../includes/app.php';
 
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EstadisticasController;
use Controllers\EstadisticasEstuController;
use Controllers\EstadisticasProfeController;
use Controllers\VigilanteController;
use Controllers\VigilantesdashboardController;
use Controllers\EventosController;
use Controllers\EventosEstuController;
use Controllers\EventosProfeController;
use Controllers\GradosController;
use Controllers\HuellasController;
use Controllers\ProfedashboardController;
use Controllers\ProfesoresController;
use Controllers\TareasController;
use Controllers\TareasEstuController;
use Controllers\VigilantesController;
use Model\Vigilantes;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Area Administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);


$router->get('/admin/añadir', [ProfesoresController::class, 'index']);
$router->get('/admin/añadir/docente/crear', [ProfesoresController::class, 'crearMatematicas']);
$router->post('/admin/añadir/docente/crear', [ProfesoresController::class, 'crearMatematicas']);
$router->get('/admin/añadir/docente/editar', [ProfesoresController::class, 'editarMatematicas']);
$router->post('/admin/añadir/docente/editar', [ProfesoresController::class, 'editarMatematicas']);
$router->post('/admin/añadir/docente/eliminar', [ProfesoresController::class, 'desactivarMatematicas']);
$router->get('/admin/añadir/docente/docentes', [ProfesoresController::class, 'matematicas']);
$router->get('/admin/docente/exportar', [VigilantesController::class, 'exportarExcel']);

$router->get('/admin/añadir/sociales/crear', [ProfesoresController::class, 'crearSociales']);
$router->post('/admin/añadir/sociales/crear', [ProfesoresController::class, 'crearSociales']);
$router->get('/admin/añadir/sociales/editar', [ProfesoresController::class, 'editarSociales']);
$router->post('/admin/añadir/sociales/editar', [ProfesoresController::class, 'editarSociales']);
$router->post('/admin/añadir/sociales/eliminar', [ProfesoresController::class, 'desactivarNaturales']);
$router->get('/admin/añadir/sociales/sociales', [ProfesoresController::class, 'sociales']);

$router->get('/admin/añadir/naturales/crear', [ProfesoresController::class, 'crearNaturales']);
$router->post('/admin/añadir/naturales/crear', [ProfesoresController::class, 'crearNaturales']);
$router->get('/admin/añadir/naturales/editar', [ProfesoresController::class, 'editarNaturales']);
$router->post('/admin/añadir/naturales/editar', [ProfesoresController::class, 'editarNaturales']);
$router->post('/admin/añadir/naturales/eliminar', [ProfesoresController::class, 'desactivarNaturales']);
$router->get('/admin/añadir/naturales/naturales', [ProfesoresController::class, 'naturales']);

$router->get('/admin/añadir/vigilante/crear', [VigilantesController::class, 'crearVigilantes']);
$router->post('/admin/añadir/vigilante/crear', [VigilantesController::class, 'crearVigilantes']);
$router->get('/admin/añadir/vigilante/editar', [VigilantesController::class, 'editarVigilantes']);
$router->post('/admin/añadir/vigilante/editar', [VigilantesController::class, 'editarVigilantes']);
$router->post('/admin/añadir/vigilante/eliminar', [VigilantesController::class, 'desactivarVigilantes']);
$router->get('/admin/añadir/vigilante/vigilantes', [VigilantesController::class, 'vigilantes']);
$router->get('/admin/vigilantes/exportar', [VigilantesController::class, 'exportarExcel']);


$router->get('/admin/añadir/ingles/crear', [ProfesoresController::class, 'crearIngles']);
$router->post('/admin/añadir/ingles/crear', [ProfesoresController::class, 'crearIngles']);
$router->get('/admin/añadir/ingles/editar', [ProfesoresController::class, 'editarIngles']);
$router->post('/admin/añadir/ingles/editar', [ProfesoresController::class, 'editarIngles']);
$router->post('/admin/añadir/ingles/eliminar', [ProfesoresController::class, 'desactivarIngles']);
$router->get('/admin/añadir/ingles/ingles', [ProfesoresController::class, 'ingles']);

$router->get('/admin/añadir/informatica/crear', [ProfesoresController::class, 'crearInformatica']);
$router->post('/admin/añadir/informatica/crear', [ProfesoresController::class, 'crearInformatica']);
$router->get('/admin/añadir/informatica/editar', [ProfesoresController::class, 'editarInformatica']);
$router->post('/admin/añadir/informatica/editar', [ProfesoresController::class, 'editarInformaticas']);
$router->post('/admin/añadir/informatica/eliminar', [ProfesoresController::class, 'desactivarInformatica']);
$router->get('/admin/añadir/informatica/informatica', [ProfesoresController::class, 'informatica']);

$router->get('/admin/huella', [HuellasController::class, 'index']);
$router->get('/admin/huella/keypad/index', [HuellasController::class, 'indexH']);
$router->get('/admin/huella/dinamica/index', [HuellasController::class, 'indexD']);
$router->post('/admin/huella/dinamica/index', [HuellasController::class, 'indexD']);
$router->get('/admin/huella/dinamica/verificar_clave', [HuellasController::class, 'indexV']);
$router->post('/admin/huella/dinamica/verificar_clave', [HuellasController::class, 'indexV']);
$router->get('/admin/huella/chat/index', [HuellasController::class, 'indexC']);
$router->post('/admin/huella/chat/index', [HuellasController::class, 'indexC']);



$router->get('/admin/grados', [GradosController::class, 'index']);
$router->get('/admin/grados/Noveno/crear', [GradosController::class, 'crearNoveno']);
$router->post('/admin/grados/Noveno/crear', [GradosController::class, 'crearNoveno']);
$router->get('/admin/grados/Noveno/editar', [GradosController::class, 'editarNoveno']);
$router->post('/admin/grados/Noveno/editar', [GradosController::class, 'editarNoveno']);
$router->post('/admin/grados/Noveno/eliminar', [GradosController::class, 'eliminarNoveno']);
$router->get('/admin/grados/Noveno/noveno', [GradosController::class, 'noveno']);

$router->get('/admin/grados/Decimo/crear', [GradosController::class, 'crearDecimo']);
$router->post('/admin/grados/Decimo/crear', [GradosController::class, 'crearDecimo']);
$router->get('/admin/grados/Decimo/editar', [GradosController::class, 'editarDecimo']);
$router->post('/admin/grados/Decimo/editar', [GradosController::class, 'editarDecimo']);
$router->post('/admin/grados/Decimo/eliminar', [GradosController::class, 'eliminarDecimo']);
$router->get('/admin/grados/Decimo/decimo', [GradosController::class, 'decimo']);

$router->get('/admin/grados/Once/crear', [GradosController::class, 'crearOnce']);
$router->post('/admin/grados/Once/crear', [GradosController::class, 'crearOnce']);
$router->get('/admin/grados/Once/editar', [GradosController::class, 'editarOnce']);
$router->post('/admin/grados/Once/editar', [GradosController::class, 'editarOnce']);
$router->post('/admin/grados/Once/eliminar', [GradosController::class, 'eliminarOnce']);
$router->get('/admin/grados/Once/once', [GradosController::class, 'once']);

$router->get('/admin/estadisticas', [EstadisticasController::class, 'index']);

// Area Profesor
$router->get('/profe/dashboard', [ProfedashboardController::class, 'index']);

$router->get('/profe/tareas', [TareasController::class, 'index']);

$router->get('/profe/eventos', [EventosProfeController::class, 'index']);

$router->get('/profe/estadisticas', [EstadisticasProfeController::class, 'index']);


// Area Vigilante
$router->get('/vigilante/dashboard', [VigilantesdashboardController::class, 'index']);



$router->get('/estudiante/tareas', [TareasEstuController::class, 'index']);

$router->get('/estudiante/eventos', [EventosEstuController::class, 'index']);

$router->get('/estudiante/estadisticas', [EstadisticasEstuController::class, 'index']);

$router->comprobarRutas();