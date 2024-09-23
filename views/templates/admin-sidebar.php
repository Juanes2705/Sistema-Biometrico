<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                inicio
            </span>
        </a>
        <a href="/admin/añadir" class="dashboard__enlace <?php echo pagina_actual('/añadir') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-user-plus"></i>
            <span class="dashboard__menu-texto">
                Añadir
            </span>
        </a>
        <a href="/admin/huella" class="dashboard__enlace <?php echo pagina_actual('/huella') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-fingerprint"></i>
            <span class="dashboard__menu-texto">
                Huella
            </span>
        </a>
        <a href="/admin/grados" class="dashboard__enlace <?php echo pagina_actual('/grados') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-file-lines"></i>
            <span class="dashboard__menu-texto">
                Reportes
            </span>
        </a>
        <a href="/admin/estadisticas" class="dashboard__enlace <?php echo pagina_actual('/estadisticas') ? 'dashboard__enlace--actual' : '' ; ?>">
            <i class="fa-solid fa-door-open"></i>
            <span class="dashboard__menu-texto">
                Accesos
            </span>
        </a>
    </nav>
</aside>