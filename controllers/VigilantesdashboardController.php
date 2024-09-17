<?php

namespace Controllers;


use MVC\Router;

class VigilantesdashboardController {

    public static function index(Router $router){
        $router->render('vigilante/dashboard/index',[
            'titulo'=>'Panel vigilante'
        ]);
    }

}