<?php

namespace Controllers;


use MVC\Router;

class EventosEstuController {

    public static function index(Router $router){
        $router->render('estudiante/eventos/index',[
            'titulo'=>'Eventos'
        ]);
    }

}
