<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="info">
                <p><?= getSesUser(['Nome']) ?></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">NAVEGAÇÃO</li>
            <li <?=(uri_string() == 'dashboard' ? 'class="active"' : '')?>>
                <a href="<?=site_url('dashboard')?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                </a>
            </li>
            <?php if (getSesPermissao(['CodPermissao']) != 1): ?>
                <li class="header">Proprietario</li>
                <li <?= (strpos(uri_string(), "dashboard/estabelecimentos") !== FALSE ? 'class="active"' : '') ?>>
                    <a href="<?= site_url('dashboard/estabelecimentos') ?>">
                        <i class="fa fa-building"></i> <span>Estabelecimentos</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (getSesPermissao(['CodPermissao']) == 3): ?>
                <li class="header">Administrador</li>
                <li <?= (strpos(uri_string(), "dashboard/tags") !== FALSE ? 'class="active"' : '') ?>>
                    <a href="<?= site_url('dashboard/tags') ?>">
                        <i class="glyphicon glyphicon-tag"></i> <span>Tags</span>
                    </a>
                </li>
                <li <?= (strpos(uri_string(), "dashboard/categorias") !== FALSE ? 'class="active"' : '') ?>>
                    <a href="<?= site_url('dashboard/categorias') ?>">
                        <i class="glyphicon glyphicon-bookmark"></i> <span>Categorias</span>
                    </a>
                </li>
                <li <?= (strpos(uri_string(), "dashboard/usuarios") !== FALSE ? 'class="active"' : '') ?>>
                    <a href="<?= site_url('dashboard/usuarios') ?>">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="header">Usuario</li>
            <li <?= (strpos(uri_string(), "dashboard/perfil") !== FALSE ? 'class="active"' : '') ?>>
                <a href="<?= site_url('dashboard/perfil') ?>">
                    <i class="glyphicon glyphicon-user"></i> <span>Perfil</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>