<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/profe/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                inicio
            </span>
        </a>
        <a href="/profe/tareas" class="dashboard__enlace <?php echo pagina_actual('/tareas') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-book dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Tareas
            </span>
        </a>
        <a href="/profe/eventos" class="dashboard__enlace <?php echo pagina_actual('/eventos') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                eventos
            </span>
        </a>
        <a href="/profe/grados" class="dashboard__enlace <?php echo pagina_actual('/grados') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                grados
            </span>
        </a>
        <a href="/profe/estadisticas" class="dashboard__enlace <?php echo pagina_actual('/estadisticas') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-chart-simple dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                estadisticas
            </span>
        </a>
    </nav>
</aside>