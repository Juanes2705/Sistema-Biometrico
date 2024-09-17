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
            placeholder="Correo Profesor"
            value="<?php echo $profesor->email ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre"
            class="formulario__input"
            placeholder="Nombre Profesor"
            value="<?php echo $profesor->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input 
            type="text" 
            name="apellido" 
            id="apellido"
            class="formulario__input"
            placeholder="Apellido Profesor"
            value="<?php echo $profesor->apellido ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Contraseña</label>
        <input 
            type="password" 
            name="password" 
            id="password"
            class="formulario__input"
            placeholder="Contraseña Profesor"
            value="<?php echo $profesor->password ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="tags_input" class="formulario__label">Experiencia (separadas por coma)</label>
        <input
            type="text"
            class="formulario__input"
            id="tags_input"
            placeholder="Ej. Matematiscas, Ingles, Naturales, Sociales, Informatica, Español"
        >

        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $profesor->tags ?? ''; ?>"> 
    </div>
</fieldset>