<?php

namespace Controllers;

use Model\Vigilantes;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class GradosController {

    public static function index(Router $router){
        $router->render('admin/grados/index',[
            'titulo'=>'Grados'
        ]);
    }

    public static function crearNoveno(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $vigilante = new Vigilantes();
        

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosNoveno';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            }
            $vigilante-> sincronizar($_POST);

            //validar
            $alertas=$vigilante->validar();

            if(empty($alertas)) {

                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Noveno/noveno');
                }

            }

        }
        
        $router->render('admin/grados/Noveno/crear',[
            'titulo'=>'Añadir vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function noveno(Router $router){
        $vigilante = Vigilantes::all();
        if(!is_admin()){
            header('Locacion: /login');
        }

        $router->render('admin/grados/Noveno/noveno',[
            'titulo'=>'Noveno',
            'vigilante'=>$vigilante
            
        ]);
    }

    public static function editarNoveno(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        

        if(!$id){
            header('Location: /admin/grados/Noveno/noveno');
        }

        //obtener profesor a editar
        $vigilante = Vigilantes::find($id);

        if(!$vigilante){
            header('Location: /admin/grados/Noveno/noveno');
        }

        $vigilante->imagen_actual=$vigilante->imagen;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosNoveno';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $vigilante->imagen_actual;
            }

            $vigilante-> sincronizar($_POST);

            $alertas=$vigilante->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );
                }

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Noveno/noveno');
                }

            }
        }

        $router->render('admin/grados/Noveno/editar',[
            'titulo'=>'Editar vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function eliminarNoveno(){
        if(!is_admin()){
            header('Locacion: /login');
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $id = $_POST['id'];
            $vigilante = Vigilantes::find($id);

            if(isset($vigilante)){
                header('Location: /admin/grados/Noveno/noveno');
            }
            
            $resultado = $vigilante->eliminar();

            if($resultado) {
                header('Location: /admin/grados/Noveno/noveno');
            }

        }
    }

    public static function crearDecimo(Router $router){
        $alertas = [];
        $vigilante = new Vigilantes();
        if(!is_admin()){
            header('Locacion: /login');
        }
        

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosDecimo';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            }
            $vigilante-> sincronizar($_POST);

            //validar
            $alertas=$vigilante->validar();

            if(empty($alertas)) {

                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Decimo/decimo');
                }

            }

        }
        
        $router->render('admin/grados/Decimo/crear',[
            'titulo'=>'Añadir vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function decimo(Router $router){
        $vigilante = Vigilantes::all();
        if(!is_admin()){
            header('Locacion: /login');
        }

        $router->render('admin/grados/Decimo/decimo',[
            'titulo'=>'Decimo',
            'vigilante'=>$vigilante
            
        ]);
    }

    public static function editarDecimo(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        

        if(!$id){
            header('Location: /admin/grados/Decimo/decimo');
        }

        //obtener profesor a editar
        $vigilante = Vigilantes::find($id);

        if(!$vigilante){
            header('Location: /admin/grados/Decimo/decimo');
        }

        $vigilante->imagen_actualD=$vigilante->imagen;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosDecimo';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $vigilante->imagen_actualD;
            }

            $vigilante-> sincronizar($_POST);

            $alertas=$vigilante->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );
                }
                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Decimo/decimo');
                }

            }
        }

        $router->render('admin/grados/Decimo/editar',[
            'titulo'=>'Editar vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function eliminarDecimo(){
        if(!is_admin()){
            header('Locacion: /login');
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $id = $_POST['id'];
            $vigilante = Vigilantes::find($id);

            if(isset($vigilante)){
                header('Location: /admin/grados/Decimo/decimo');
            }
            
            $resultado = $vigilante->eliminar();

            if($resultado) {
                header('Location: /admin/grados/Decimo/decimo');
            }

        }
    }

    public static function crearOnce(Router $router){
        $alertas = [];
        $vigilante = new Vigilantes();
        if(!is_admin()){
            header('Locacion: /login');
        }
        

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosOnce';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            }
            $vigilante-> sincronizar($_POST);

            //validar
            $alertas=$vigilante->validar();

            if(empty($alertas)) {

                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Once/once');
                }

            }

        }
        
        $router->render('admin/grados/Once/crear',[
            'titulo'=>'Añadir vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function once(Router $router){
        $vigilante = Vigilantes::all();
        if(!is_admin()){
            header('Locacion: /login');
        }

        $router->render('admin/grados/Once/once',[
            'titulo'=>'Once',
            'vigilante'=>$vigilante
            
        ]);
    }

    public static function editarOnce(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        

        if(!$id){
            header('Location: /admin/grados/Once/once');
        }

        //obtener profesor a editar
        $vigilante = Vigilantes::find($id);

        if(!$vigilante){
            header('Location: /admin/grados/Once/once');
        }

        $vigilante->imagen_actualO=$vigilante->imagen;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!is_admin()){
                header('Locacion: /login');
            }

            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/img/fotosDecimo';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true) );

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $vigilante->imagen_actualO;
            }

            $vigilante-> sincronizar($_POST);

            $alertas=$vigilante->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png" );
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp" );
                }

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/grados/Once/once');
                }

            }
        }

        $router->render('admin/grados/Once/editar',[
            'titulo'=>'Editar vigilante',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function eliminarOnce(){
        if(!is_admin()){
            header('Locacion: /login');
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $id = $_POST['id'];
            $vigilante = Vigilantes::find($id);

            if(isset($vigilante)){
                header('Location: /admin/grados/Once/once');
            }
            
            $resultado = $vigilante->eliminar();

            if($resultado) {
                header('Location: /admin/grados/Once/once');
            }

        }
    }

}
