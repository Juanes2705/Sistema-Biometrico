<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">
        Informacion Personal
    </legend>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">Correo</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            class="formulario__input"
            placeholder="Correo estudiante"
            value="<?php echo $estudiante->email ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre"
            class="formulario__input"
            placeholder="Nombre estudiante"
            value="<?php echo $estudiante->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input 
            type="text" 
            name="apellido" 
            id="apellido"
            class="formulario__input"
            placeholder="Apellido estudiante"
            value="<?php echo $estudiante->apellido ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="edad" class="formulario__label">Edad</label>
        <input 
            type="number" 
            name="edad" 
            id="edad"
            class="formulario__input"
            placeholder="Edad estudiante"
            value="<?php echo $estudiante->edad ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="sexo" class="formulario__label">Sexo</label>
        <input 
            type="text" 
            name="sexo" 
            id="sexo"
            class="formulario__input"
            placeholder="Sexo estudiante"
            value="<?php echo $estudiante->sexo ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Contraseña</label>
        <input 
            type="password" 
            name="password" 
            id="password"
            class="formulario__input"
            placeholder="Contraseña estudiante"
            value="<?php echo $estudiante->password ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Foto</label>
        <input
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        >
    </div>

    <?php if(isset($estudiante->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosNoveno/' . $estudiante->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosNoveno/' . $estudiante->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/fotosNoveno/' . $estudiante->imagen; ?>.png" alt="Imagen estudiante">
            </picture>
        </div>

    <?php } ?>

    <?php if(isset($estudiante->imagen_actualD)) { ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosDecimo/' . $estudiante->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosDecimo/' . $estudiante->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/fotosDecimo/' . $estudiante->imagen; ?>.png" alt="Imagen estudiante">
            </picture>
        </div>

    <?php } ?>

    <?php if(isset($estudiante->imagen_actualO)) { ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosOnce/' . $estudiante->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/fotosOnce/' . $estudiante->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/fotosOnce/' . $estudiante->imagen; ?>.png" alt="Imagen estudiante">
            </picture>
        </div>

    <?php } ?>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Grados</legend>

    <div class="formulario__campo">
        <label for="grado_input" class="formulario__label">Experiencia (separadas por coma)</label>
        <input
            type="text"
            class="formulario__input"
            id="grado_input"
            placeholder="Ej. Noveno, Decimo, Once"
        >

        <div id="grado" class="formulario__listado"></div>
        <input type="hidden" name="grado" value="<?php echo $estudiante->grado ?? ''; ?>"> 
    </div>
</fieldset>