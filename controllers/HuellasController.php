<?php

namespace Controllers;


use MVC\Router;

class HuellasController {

    public static function index(Router $router){
        $router->render('admin/huella/index',[
            'titulo'=>'Sistema de Huella'
        ]);
    }
    public static function indexH(Router $router){
        $router->render('admin/huella/keypad/index',[
            'titulo'=>'Keypad'
        ]);
    }

    public static function indexD(Router $router){
        $router->render('admin/huella/dinamica/index',[
            'titulo'=>'Clave Dinamica'
        ]);
    }
    public static function indexV(Router $router){
        $router->render('admin/huella/dinamica/verificar_clave',[
            'titulo'=>'Clave Prueba'
        ]);
    }


}

