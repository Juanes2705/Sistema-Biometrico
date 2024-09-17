<?php

namespace Controllers;


use MVC\Router;

class EventosProfeController {

    public static function index(Router $router){
        $router->render('profe/eventos/index',[
            'titulo'=>'Eventos'
        ]);
    }

}
