<?php

namespace Controllers;


use MVC\Router;

class EstadisticasProfeController {

    public static function index(Router $router){
        $router->render('profe/estadisticas/index',[
            'titulo'=>'Estadisticas'
        ]);
    }

}
