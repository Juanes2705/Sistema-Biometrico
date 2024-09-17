<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton-mate" href="/admin/grados/Noveno/crear">
        <i class="fa-solid fa-circle-plus"></i>
            Añadir Estudiante
    </a>
    <a class="dashboard__boton-mate" href="/admin/grados">
        <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
    </a>
</div>

<div class="dashboard__contenedor">
    <?php 
    $estudiantesConTagEspecifico = array_filter($estudiante, function($estudiantes) {
        // Separa las etiquetas por coma, espacio u otro delimitador
        $tagsArray = explode(',', $estudiantes->grado);

        // Retorna true si el tag específico está en la lista de etiquetas
        return in_array('Noveno', array_map('trim', $tagsArray)); // Ajusta 'Noveno' al tag específico
    });

    if (!empty($estudiantesConTagEspecifico)) { 
    ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Correo</th>
                    <th scope="col" class="table__th">Materias</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
            <?php foreach ($estudiantesConTagEspecifico as $estudiantes) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo htmlspecialchars($estudiantes->nombre . " " . $estudiantes->apellido, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($estudiantes->email, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php
                            // Mostrar solo "Español" si está en los tags
                            $tagsArray = explode(',', $estudiantes->grado);
                            $filteredTags = array_filter($tagsArray, function($grados) {
                                return trim($grados) === 'Noveno';
                            });

                            echo htmlspecialchars(implode(', ', $filteredTags), ENT_QUOTES, 'UTF-8');
                        ?>
                    </td>
                    <td class="table__td--acciones">
                        <a class="table__accion table__accion--editar" href="/admin/grados/Noveno/editar?id=<?php echo htmlspecialchars($estudiantes->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/grados/Noveno/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($estudiantes->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Estudiantes de Noveno</p>
    <?php } ?>
</div>


