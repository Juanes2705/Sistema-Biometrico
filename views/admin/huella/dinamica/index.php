<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<?php

function claveDinamica($length = 6){
    // Genera una clave en base al tiempo actual (redondeado a cada 5 minutos)
    $tiempo_actual = time();
    $tiempo_base = floor($tiempo_actual / (5 * 60)); // Cada 5 minutos
    $clave_base = hash('sha256', $tiempo_base); // Hashear el tiempo base 
    $clave_numerica = preg_replace('/[^0-9]/', '', $clave_base); 
    
    return substr($clave_numerica, 0, $length); // Extraer una parte numérica del hash
}

$miClaveDinamica = claveDinamica();
?>

<?php
    echo $miClaveDinamica;
?>
