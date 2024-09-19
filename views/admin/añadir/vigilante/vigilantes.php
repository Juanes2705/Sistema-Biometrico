<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton-mate" href="/admin/añadir/vigilante/crear">
        <i class="fa-solid fa-circle-plus"></i>
            Añadir Vigilante
    </a>

    <input type="text" id="filter-input" class="dashboard__filter-input" placeholder="Filtrar vigilante";">

    <a class="dashboard__boton-mate" href="/admin/añadir">
        <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
    </a>

    

</div>
<div class="dashboard__contenedor">
    <?php if (!empty($vigilante)) { ?>
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
            <?php foreach ($vigilante as $vigilantes) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo htmlspecialchars($vigilantes->nombre . " " . $vigilantes->apellido, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($vigilantes->email, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td">
                        <?php echo htmlspecialchars($vigilantes->tags, ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__td--acciones">
                        <a class="table__accion table__accion--editar" href="/admin/añadir/vigilante/editar?id=<?php echo htmlspecialchars($vigilantes->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>

                        <form method="POST" action="/admin/añadir/vigilante/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($vigilantes->id, ENT_QUOTES, 'UTF-8'); ?>">
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
        <p class="text-center">No hay Vigilantes</p>
    <?php } ?>

    <a class="dashboard__boton-mate" href="/admin/vigilantes/exportar" target="_blank">
        <i class="fa-solid fa-file-excel"></i>
        Exportar Excel
    </a>

</div>

<?php
    echo $paginacion;
?>
