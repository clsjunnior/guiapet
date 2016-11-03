<!--Header-->
<?php $this->load->view('admin/layout/header') ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <!--    Barra de cima-->
    <?php $this->load->view('admin/layout/header_menu') ?>

    <!--    Menu da esquerda-->
    <?php $this->load->view('admin/layout/left_menu') ?>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Usuarios
                <small>Administração de usuarios</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Usuarios</li>
            </ol>
        </section>


        <section class="content">


            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="tbEstabelecimentos" class="table table-bordered table-hover dataTable"
                                   role="grid">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Qtd. de estabelecimentos</th>
                                    <th>Permissao</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($usuarios) && count($usuarios) > 0): ?>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <tr>
                                            <td><?= $usuario['UrNome'] ?></td>
                                            <td><?= $usuario['UrLogin'] ?></td>
                                            <td><?= $usuario['qtdEst'] ?></td>
                                            <td><?= $usuario['PeNome'] ?></td>
                                            <td>
                                                <button class="btn btn-block btn-primary"
                                                        data-id="<?= $usuario['CodUsuario'] ?>" type="button">Alterar
                                                    permissão
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum usuario cadastrado no momento</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <!--    Créditos-->
    <?php $this->load->view('admin/layout/credits') ?>

</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css') ?>">
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
    $.fn.dataTable.ext.errMode = 'none';
    $(document).ready(function () {
        $("#tbEstabelecimentos").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>
</body>
</html>
