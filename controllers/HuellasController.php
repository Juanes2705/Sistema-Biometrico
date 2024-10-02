<?php

namespace Controllers;

use MVC\Router;

class HuellasController {

    public static function index(Router $router){
        $router->render('admin/huella/index',[
            'titulo'=>'Sistema de Huella'
        ]);
    }
    
    public static function indexH(Router $router){
        $router->render('admin/huella/keypad/index',[
            'titulo'=>'Keypad'
        ]);
    }

    public static function indexD(Router $router){
        $router->render('admin/huella/dinamica/index',[
            'titulo'=>'Clave Dinamica'
        ]);
    }

    public static function indexV(Router $router){
        $router->render('admin/huella/dinamica/verificar_clave',[
            'titulo'=>'Clave Prueba'
        ]);
    }

    // Renderiza la vista del chat y maneja las respuestas del chatbot
    public static function indexC(Router $router){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el mensaje enviado mediante POST
            $data = json_decode(file_get_contents("php://input"), true);
            $message = $data['message'] ?? '';

            // Llamar a la lógica del chatbot para generar una respuesta
            $response = self::getChatbotResponse($message);

            // Devolver la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode(['response' => $response]);
            return; // Asegura que no siga ejecutando más código después del JSON
        }

        // Renderizar la vista del chat si la solicitud no es POST
        $router->render('admin/huella/chat/index', [
            'titulo' => 'Chat en línea'
        ]);
    }

    // Método para generar una respuesta básica del chatbot
    private static function getChatbotResponse($message) {
        // Lógica básica del chatbot
        if (stripos($message, 'hola') !== false) {
            return '¡Hola! ¿Cómo puedo ayudarte hoy?';
        } elseif (stripos($message, 'adios') !== false) {
            return '¡Adiós! Que tengas un buen día.';
        }

        // Respuesta predeterminada
        return 'Lo siento, no entiendo tu mensaje.';
    }
}
