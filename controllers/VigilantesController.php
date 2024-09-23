<?php

namespace Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Classes\Paginacion;
use Model\Vigilantes;
use MVC\Router;

class VigilantesController {

    


    public static function index(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $router->render('admin/añadir/index',[
            'titulo'=>'Añadir'
            
        ]);
    }

    public static function crearVigilantes(Router $router){
        $alertas = [];
        $vigilante = new Vigilantes;
        if(!is_admin()){
            header('Locacion: /login');
        }
        

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $vigilante-> sincronizar($_POST);

            //validar
            $alertas=$vigilante->validar();

            if(empty($alertas)) {
                
                $vigilante->hashPassword();

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/añadir/vigilante/vigilantes');
                }

            }

        }
        
        $router->render('admin/añadir/vigilante/crear',[
            'titulo'=>'Añadir Vigilantes',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function vigilantes(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        
        $pagina_actual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if ($pagina_actual < 1) {
            header('Location: /admin/añadir/vigilante/vigilantes?page=1');
        }
        $registros_por_pagina = 10;
        $total = Vigilantes::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/añadir/vigilante/vigilantes?page=1');
        }

        $vigilante = Vigilantes::paginar($registros_por_pagina, $paginacion->offset());


        $router->render('admin/añadir/vigilante/vigilantes',[
            'titulo'=>'Añadir Vigilantes',
            'vigilante'=>$vigilante,
            'paginacion' => $paginacion->paginacion()
            
        ]);
    }

    public static function editarVigilantes(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        

        if(!$id){
            header('Location: /admin/añadir/vigilante/vigilantes');
        }

        //obtener profesor a editar
        $vigilante = Vigilantes::find($id);

        if(!$vigilante){
            header('Location: /admin/añadir/vigilante/vigilantes');
        }

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $vigilante-> sincronizar($_POST);


            $alertas=$vigilante->validar();

            if(empty($alertas)) {

                $vigilante->hashPassword();

                $resultado = $vigilante->guardar();

                if($resultado) {
                    header('Location: /admin/añadir/vigilante/vigilantes');
                }

            }
        }

        $router->render('admin/añadir/vigilante/editar',[
            'titulo'=>'Editar Vigilantes',
            'alertas'=>$alertas,
            'vigilante'=>$vigilante
        ]);
    }
    public static function desactivarVigilantes() {
        if (!is_admin()) {
            header('Location: /login'); // Asegúrate de salir después de redirigir
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica que el campo id esté definido
            if (!isset($_POST['id'])) {
                // Maneja el error de que no se envió el ID
                header('Location: /admin/añadir/vigilante/vigilantes');
                exit;
            }
    
            $id = (int)$_POST['id']; // Convierte a entero para mayor seguridad
            $vigilante = Vigilantes::find($id);
    
            if (!$vigilante) {
                // Si no se encuentra el profesor, redirige o muestra un mensaje de error
                header('Location: /admin/añadir/vigilante/vigilantes');
                exit;
            }
    
            // Cambia el estado del profesor a inactivo
            $vigilante->confirmado = 0; // Asume que '0' significa desactivado
            $resultado = $vigilante->guardar(); // Asume que el modelo tiene un método 'guardar'
    
            if ($resultado) {
                header('Location: /admin/añadir/vigilante/vigilantes');
                exit;
            } else {
                // Maneja el error si no se puede guardar
                // Tal vez redirigir o mostrar un mensaje de error
                header('Location: /admin/añadir/vigilante/error');
                exit;
            }
        }
    }

    public static function exportarExcel() {
        // Obtener los datos de los vigilantes
        $vigilantes = Vigilantes::all(); // O la consulta que estés utilizando para obtener los vigilantes

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Escribir los encabezados
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'Correo');
        $sheet->setCellValue('C1', 'Materias');

        // Rellenar los datos de los vigilantes
        $fila = 2; // Empezar en la segunda fila, debajo de los encabezados
        foreach ($vigilantes as $vigilante) {
            $sheet->setCellValue("A{$fila}", $vigilante->nombre . ' ' . $vigilante->apellido);
            $sheet->setCellValue("B{$fila}", $vigilante->email);
            $sheet->setCellValue("C{$fila}", $vigilante->tags);
            $fila++;
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Enviar el archivo como respuesta
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vigilantes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    
}    