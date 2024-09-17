<?php

namespace Controllers;


use MVC\Router;

class TareasEstuController {

    public static function index(Router $router){
        $router->render('estudiante/tareas/index',[
            'titulo'=>'Tareas'
        ]);
    }

}