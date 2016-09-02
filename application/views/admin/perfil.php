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

            <div class="box box-success collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados pessoais</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <form action="<?=site_url('dashboard/perfil')?>" method="post" class="form-horizontal">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nome">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="nome" id="nome" name="nome" value="<?=set_value('name',$user['name'])?>" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">E-mail:</label>
                                    <div class="col-sm-10">
                                        <input type="email" placeholder="E-mail" id="email" name="email" value="<?=set_value('email',$user['email'])?>" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="sex" class="col-sm-4 control-label">Sexo:</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" value="M" name="sex" <?=set_radio('sexo', 'M', TRUE)?>> Maculino</label>
                                        <label><input type="radio" value="F" name="sex" <?=set_radio('sexo', 'F')?>> Feminino</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="tel">Telefone:</label>
                                    <div class="col-sm-10">
                                        <input type="tel" placeholder="Telefone" id="tel" name="tel" value="<?=set_value('tel',$user['tel'])?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="senha">Senha:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Senha" id="senha" name="senha" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="senhaConf">Confirmação:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Confirmação" id="senhaConf" name="senhaConf" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="senhaAtual">Senha Atual:</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="Senha atual" id="senhaAtual" name="senhaAtual" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer text-right">
                        <button class="btn  btn-success btn-sm" type="submit" value="perfil">Alterar</button>
                    </div>
                </form>

            </div>

            <div class="box box-info ">
                <div class="box-header with-border">
                    <h3 class="box-title">Endereço</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <form action="<?=site_url('dashboard/perfil')?>" method="post" class="form-horizontal">
                <div class="box-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="state">Estado:</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Estado" id="state" name="state" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="city">Cidade:</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Cidade" id="city" name="city" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="zip_code">Cep:</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Cep" id="zip_code" name="zip_code" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="street">Endereço:</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Endereço" id="street" name="street" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="neigborhood">Bairro:</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Bairro" id="neigborhood" name="neigborhood" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="complement">Complemento:</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Complemento" id="complement" name="complement" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    </form>
                <div class="box-footer text-right">
                    <button class="btn  btn-info btn-sm" type="submit" value="perfil">Alterar</button>
                </div>

            </div>

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
