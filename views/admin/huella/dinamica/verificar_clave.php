<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<?php
// verificar_clave.php

// Depuración: Verificar si se ha enviado una clave
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la clave fue enviada
    $claveIngresada = $_POST['clave'] ?? null;
    if ($claveIngresada === null) {
        echo "No se ha recibido ninguna clave.";
        exit;
    }

    // Función para generar la clave dinámica
    function claveDinamica($length = 6){
        $tiempo_actual = time();
        $tiempo_base = floor($tiempo_actual / (5 * 60)); // Cada 5 minutos
        $clave_base = hash('sha256', $tiempo_base);
        $clave_numerica = preg_replace('/[^0-9]/', '', $clave_base);
        return substr($clave_numerica, 0, $length);
    }

    // Generar la clave dinámica actual
    $miClaveDinamica = claveDinamica();

    // Comparar las claves
    if ($miClaveDinamica === $claveIngresada) {
        echo "<div class='success-message'>Acceso concedido. Bienvenido.</div>";
    } else {
        echo "<div class='error-message'>Acceso denegado. Clave incorrecta.</div>";
    }
} else {
    echo "<div class='error-message'>Método de solicitud incorrecto.</div>";
}
?>
