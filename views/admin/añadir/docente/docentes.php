<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton-mate" href="/admin/añadir/docente/crear">
        <i class="fa-solid fa-circle-plus"></i>
            Añadir Profesor
    </a>

    <input type="text" id="filterP-input" class="dashboard__filter-input" placeholder="Filtrar Profesor";">

    <a class="dashboard__boton-mate" href="/admin/añadir">
        <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
    </a>
</div>
<div class="dashboard__contenedor">
    <?php if (!empty($profesor)) { ?>
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
            <?php foreach ($profesor as $profesores) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo htmlspecialchars($profesores->nombre . " " . $profesores->apellido, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($profesores->email, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($profesores->tags, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td--acciones">
                        <a class="table__accion table__accion--editar" href="/admin/añadir/docente/editar?id=<?php echo htmlspecialchars($profesores->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/añadir/docente/eliminar" class="table__formulario">
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
        <p class="text-center">No hay Profesores</p>
    <?php } ?>
</div>

<a class="dashboard__boton-mate" href="/admin/docente/exportar">
        <i class="fa-solid fa-file-excel"></i>
        Exportar a Excel
    </a>

<?php
    echo $paginacion;
?>
