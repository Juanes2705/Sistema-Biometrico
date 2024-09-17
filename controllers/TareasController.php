<?php

namespace Controllers;


use MVC\Router;

class TareasController {

    public static function index(Router $router){
        $router->render('profe/tareas/index',[
            'titulo'=>'Tareas'
        ]);
    }

}