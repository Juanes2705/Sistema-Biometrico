<?php

require 'vendor/autoload.php'; // Asegúrate de tener PhpSpreadsheet instalado

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportarVigilantes($vigilantes) {
    // Crear un nuevo archivo de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Encabezados
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Correo');
    $sheet->setCellValue('C1', 'Materias');
    
    // Contenido
    $fila = 2; // Empezamos en la fila 2 ya que la 1 es para los encabezados
    foreach ($vigilantes as $vigilante) {
        $sheet->setCellValue('A' . $fila, $vigilante->nombre . ' ' . $vigilante->apellido);
        $sheet->setCellValue('B' . $fila, $vigilante->email);
        $sheet->setCellValue('C' . $fila, $vigilante->tags);
        $fila++;
    }

    // Generar el archivo Excel
    $writer = new Xlsx($spreadsheet);
    
    // Enviar el archivo al navegador para su descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="vigilantes.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

// Obtener los vigilantes desde la base de datos
$vigilantes = obtenerVigilantes(); // Esta función es un ejemplo, deberás adaptarla a tu código real

// Llamar a la función para exportar los vigilantes
exportarVigilantes($vigilantes);

?>
