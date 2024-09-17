<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        // Asignar los datos a variables para la vista
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        // Incluir la vista específica
        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpiar el buffer

        // Determinar el layout a usar según la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        // Si es para administradores, cargar el layout admin
        if (str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        } elseif (str_contains($url_actual, '/profe')) {
            // Si es para vigilantes, cargar un layout diferente
            include_once __DIR__ . '/views/profe-layout.php';
        } elseif (str_contains($url_actual, '/vigilante')) {
            // Si es para vigilantes, cargar un layout diferente
            include_once __DIR__ . '/views/vigilante-layout.php';
        }else {
            // Para otras rutas, usar el layout general
            include_once __DIR__ . '/views/layout.php';
        }
    }
}
