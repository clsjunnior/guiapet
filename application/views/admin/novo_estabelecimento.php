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
                <?=$title?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li><a href="<?=site_url('dashboard/estabelecimentos')?>"> Estabelecimentos</a></li>
                <li class="active"><?=$title?></li>
            </ol>
        </section>


        <section class="content">


            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Estabelecimento</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?=site_url('dashboard/perfil')?>" method="post" class="form-horizontal">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">
                                    <?= form_error('name', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="name">Nome:</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="name" id="name" name="name"
                                                   value="<?= set_value('name', $establishment['name']) ?>" required
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <?= form_error('site', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="website">Site:</label>
                                        <div class="col-sm-10">
                                            <input type="url" placeholder="Site" id="website" name="website" value="<?=set_value('website',$establishment['website'])?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <?= form_error('tel', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="tel">Telefone:</label>
                                        <div class="col-sm-8">
                                            <input type="tel" placeholder="Telefone" id="tel" name="tel" class="form-control" value="<?=set_value('tel',$establishment['tel'])?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <?= form_error('cnpj', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="cnpj">CNPJ:</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="CNPJ" id="cnpj" name="cnpj" class="form-control" required value="<?=set_value('cnpj',$establishment['cnpj'])?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <?= form_error('photograp', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-2 pull-left">
                                            <img alt="Foto estabelecimento" class="img-responsive img-md" id="imgE">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="photograph">Fotografia</label>
                                            <input id="photograph" type="file" accept="image/*" onchange="loadFile(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4  ">
                                    <?= form_error('category', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                    <label for="category">Categoria</label>
                                    <select name="category" id="category" required class="form-control">
                                        <option>Selecionar</option>
                                        <?php foreach ($categories as $category):?>
                                            <option value="<?=$category->id?>"><?=$category->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer text-right">
                            <button class="btn  btn-success btn-sm" type="submit" value="perfil" name="submit">Alterar
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Localização</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

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
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imgE');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    $(document).ready(function () {
        $("#tel").inputmask("(999) 99999-9999");
        $("#cnpj").inputmask(" 99.999.999/9999-99");
    })
</script>

</body>
</html>
