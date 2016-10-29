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
            <h1>Perfil</h1>
            <ol class="breadcrumb">
                <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>


        <section class="content">

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados pessoais<small>(Usuário)</small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <form action="<?=site_url('dashboard/perfil')?>" method="post" class="form-horizontal">
                    <div class="box-body">

                        <?= $this->session->flashdata('perfil') ?>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= form_error('name', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="name" id="name" name="name"
                                               value="<?= set_value('name', $user['Nome']) ?>" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="login" class="col-sm-4 control-label">Login:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?=getSesUser(['Login'])?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?= form_error('sex', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label for="sex" class="col-sm-4 control-label">Sexo:</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" value="M"
                                                      name="sex" <?= set_radio('sex', 'M', TRUE) ?>> Maculino</label>
                                        <label><input type="radio" value="F" name="sex" <?= set_radio('sex', 'F') ?>>
                                            Feminino</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?= form_error('password', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="password">Nova senha:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Nova senha" id="password" name="password"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?= form_error('passwordConf', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="passwordConf">Confirmação:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Confirmação" id="passwordConf" name="passwordConf" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-6">
                                <?= form_error('passwordAtual', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="passwordAtual">Senha Atual:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Senha atual" id="passwordAtual" name="passwordAtual" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer text-right">
                        <button class="btn  btn-success btn-sm" type="submit" value="perfil" name="submit">Alterar
                        </button>
                    </div>
                </form>

            </div>

            <form action="<?=site_url('dashboard/perfil')?>" method="post" class="form-horizontal">
                <?php $this->load->view('admin/layout/fragmentos/box_localizacao')?>
            </form>

        </section>

    </div>

    <!--    Créditos-->
    <?php $this->load->view('admin/layout/credits') ?>

</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>
<script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script>
    $(document).ready(function () {
        $("#tel").inputmask("(999) 99999-9999");
        $("#zip_code").inputmask("99999-999");
    })
</script>
</body>
</html>
