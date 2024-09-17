<?php

namespace Controllers;


use MVC\Router;

class ProfedashboardController {

    public static function index(Router $router){
        $router->render('profe/dashboard/index',[
            'titulo'=>'Panel Profesor'
        ]);
    }

}