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
                                    <th>ID</th>
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
                                            <td><?= $usuario['UrCodUsuario'] ?></td>
                                            <td><?= $usuario['UrNome'] ?></td>
                                            <td><?= $usuario['UrLogin'] ?></td>
                                            <td><?= $usuario['qtdEst'] ?></td>
                                            <td get-id="<?= $usuario['UrCodUsuario'] ?>"><?= $usuario['PeNome'] ?></td>
                                            <td>
                                                <button class="btn btn-block btn-primary altPermissao"
                                                        data-toggle="modal" data-target="#modalPermissao"
                                                        data-id="<?= $usuario['UrCodUsuario'] ?>"
                                                        data-nome="<?= $usuario['UrNome'] ?>"
                                                        data-login="<?= $usuario['UrLogin'] ?>" type="button">Alterar
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

<div class="modal fade" id="modalPermissao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url("api/usuario/altpermissao") ?>"
              class="form-horizontal" method="post" id="alteraPermissao">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Alterar Permissão</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="id" class="col-sm-4 control-label">ID:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled id="id" name="id">
                            <input type="hidden" id="idv" name="id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nome" class="col-sm-4 control-label">Nome:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled id="nome" name="nome">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login" class="col-sm-4 control-label">Login:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled id="login" name="login">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="category">Tipo permissão:</label>
                        <div class="col-sm-7">
                            <select name="permissao" id="permissao" required class="form-control">
                                <?php foreach ($permissoes as $permissao): ?>
                                    <option
                                        value="<?= $permissao->CodPermissao ?>"
                                        data-nome="<?= $permissao->Nome ?>"><?= $permissao->Nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="submit" value="contato" class="btn btn-success">Alterar</button>
                    </div>
                </div>
        </form>
    </div>
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

    var id;
    $(".altPermissao").click(function () {
        id = $(this).attr("data-id");
        var nome = $(this).attr("data-nome");
        var login = $(this).attr("data-login");

        $("#id").val(id);
        $("#idv").val(id);
        $("#nome").val(nome);
        $("#login").val(login);
    });

    $("#alteraPermissao").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),

        }).done(function (data) {
            $("td[get-id=" + id + "]").html(data);
        });

        $("#modalPermissao").modal('hide');

    })
</script>
</body>
</html>
