<header class="main-header">
    <!-- Logo -->
    <a href="<?=site_url('dashboard')?>" class="logo">

        <span class="logo-mini"><b>G</b>PT</span>

        <span class="logo-lg"><b>Guia</b>Pet</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?= getSesUser(['Login']) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?= getSesUser(['Nome']) ?>
                                <small>Tipo de usuario: <b><?= getSesPermissao(['Nome']) ?></b></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <?php if (getSesPermissao(['CodPermissao']) == 1): ?>
                                        <a href="<?= site_url('dashboard/estabelecimentos/novo') ?>">Vire um <b>Proprietário</b>
                                            e divulgue seu estabelecimento!</a>
                                    <?php else: ?>
                                        <a href="<?= site_url('dashboard/estabelecimentos') ?>">Estabelecimentos</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=site_url('dashboard/perfil')?>" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?=site_url('sair')?>" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>