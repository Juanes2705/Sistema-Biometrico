<?php

namespace Controllers;


use MVC\Router;

class EstadisticasController {

    public static function index(Router $router){
        $router->render('admin/estadisticas/index',[
            'titulo'=>'estadisticas'
        ]);
    }

}

