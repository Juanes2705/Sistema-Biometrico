<?php

namespace Controllers;


use MVC\Router;

class EstadisticasEstuController {

    public static function index(Router $router){
        $router->render('estudiante/estadisticas/index',[
            'titulo'=>'Estadisticas'
        ]);
    }

}
