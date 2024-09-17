<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton-mate" href="/admin/profesores/informatica/crear">
        <i class="fa-solid fa-circle-plus"></i>
            Añadir Profesor
    </a>
    <a class="dashboard__boton-mate" href="/admin/profesores">
        <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
    </a>
</div>

<div class="dashboard__contenedor">
    <?php 
    $profesoresConTagEspecifico = array_filter($profesor, function($profesores) {
        // Separa las etiquetas por coma, espacio u otro delimitador
        $tagsArray = explode(',', $profesores->tags);

        // Retorna true si el tag específico está en la lista de etiquetas
        return in_array('Informatica', array_map('trim', $tagsArray)); // Ajusta 'Informatica' al tag específico
    });

    if (!empty($profesoresConTagEspecifico)) { 
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
            <?php foreach ($profesoresConTagEspecifico as $profesores) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo htmlspecialchars($profesores->nombre . " " . $profesores->apellido, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($profesores->email, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php
                            // Mostrar solo "Informatica" si está en los tags
                            $tagsArray = explode(',', $profesores->tags);
                            $filteredTags = array_filter($tagsArray, function($tag) {
                                return trim($tag) === 'Informatica';
                            });

                            echo htmlspecialchars(implode(', ', $filteredTags), ENT_QUOTES, 'UTF-8');
                        ?>
                    </td>
                    <td class="table__td--acciones">
                        <a class="table__accion table__accion--editar" href="/admin/profesores/informatica/editar?id=<?php echo htmlspecialchars($profesores->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/profesores/informatica/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($profesores->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Desactivar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Profesores de Informatica</p>
    <?php } ?>
</div>

