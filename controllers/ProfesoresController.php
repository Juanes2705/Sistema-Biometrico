<?php

namespace Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Classes\Paginacion;
use Model\Profesores;
use MVC\Router;

class ProfesoresController {

    public static function index(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $router->render('admin/añadir/index',[
            'titulo'=>'Añadir'
            
        ]);
    }

    public static function crearMatematicas(Router $router){
        $alertas = [];
        $profesor = new Profesores;
        if(!is_admin()){
            header('Locacion: /login');
        }
        

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $profesor-> sincronizar($_POST);

            //validar
            $alertas=$profesor->validar();

            if(empty($alertas)) {
                
                $profesor->hashPassword();

                $resultado = $profesor->guardar();

                if($resultado) {
                    header('Location: /admin/añadir/docente/docentes');
                }

            }

        }
        
        $router->render('admin/añadir/docente/crear',[
            'titulo'=>'Añadir Profesores',
            'alertas'=>$alertas,
            'profesor'=>$profesor
        ]);
    }
    public static function matematicas(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        
        $pagina_actual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if ($pagina_actual < 1) {
            header('Location: /admin/añadir/docente/docentes?page=1');
        }
        $registros_por_pagina = 10;
        $total = Profesores::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/añadir/docente/docentes?page=1');
        }

        $profesor = Profesores::paginar($registros_por_pagina, $paginacion->offset());


        $router->render('admin/añadir/docente/docentes',[
            'titulo'=>'Añadir',
            'profesor'=>$profesor,
            'paginacion' => $paginacion->paginacion()
            
        ]);
    }

    public static function editarMatematicas(Router $router){
        if(!is_admin()){
            header('Locacion: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        

        if(!$id){
            header('Location: /admin/añadir/docente/docentes');
        }

        //obtener profesor a editar
        $profesor = Profesores::find($id);

        if(!$profesor){
            header('Location: /admin/añadir/docente/docentes');
        }

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $profesor-> sincronizar($_POST);


            $alertas=$profesor->validar();

            if(empty($alertas)) {

                $profesor->hashPassword();

                $resultado = $profesor->guardar();

                if($resultado) {
                    header('Location: /admin/añadir/docente/docentes');
                }

            }
        }

        $router->render('admin/añadir/docente/editar',[
            'titulo'=>'Editar Profesores',
            'alertas'=>$alertas,
            'profesor'=>$profesor
        ]);
    }
    public static function desactivarMatematicas() {
        if (!is_admin()) {
            header('Location: /login'); // Asegúrate de salir después de redirigir
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica que el campo id esté definido
            if (!isset($_POST['id'])) {
                // Maneja el error de que no se envió el ID
                header('Location: /admin/añadir/docente/docentes');
                exit;
            }
    
            $id = (int)$_POST['id']; // Convierte a entero para mayor seguridad
            $profesor = Profesores::find($id);
    
            if (!$profesor) {
                // Si no se encuentra el profesor, redirige o muestra un mensaje de error
                header('Location: /admin/añadir/docente/docentes');
                exit;
            }
    
            // Cambia el estado del profesor a inactivo
            $profesor->confirmado = 0; // Asume que '0' significa desactivado
            $resultado = $profesor->guardar(); // Asume que el modelo tiene un método 'guardar'
    
            if ($resultado) {
                header('Location: /admin/añadir/docente/docentes');
                exit;
            } else {
                // Maneja el error si no se puede guardar
                // Tal vez redirigir o mostrar un mensaje de error
                header('Location: /admin/añadir/docente/error');
                exit;
            }
        }
    }

    public static function exportarExcel() {
        // Obtener los datos de los vigilantes
        $profesor = Profesores::all(); // O la consulta que estés utilizando para obtener los vigilantes

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Escribir los encabezados
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'Correo');
        $sheet->setCellValue('C1', 'Materias');

        // Rellenar los datos de los vigilantes
        $fila = 2; // Empezar en la segunda fila, debajo de los encabezados
        foreach ($profesor as $profesores) {
            $sheet->setCellValue("A{$fila}", $profesores->nombre . ' ' . $profesores->apellido);
            $sheet->setCellValue("B{$fila}", $profesores->email);
            $sheet->setCellValue("C{$fila}", $profesores->tags);
            $fila++;
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Enviar el archivo como respuesta
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="profesores.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    
}    