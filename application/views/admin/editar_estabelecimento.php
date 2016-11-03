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
                <?= $title ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li><a href="<?= site_url('dashboard/estabelecimentos') ?>"> Estabelecimentos</a></li>
                <li class="active"><?= $title ?></li>
            </ol>
        </section>


        <section class="content">

            <form action="<?= site_url('dashboard/estabelecimentos/editar/' . $id) ?>" enctype="multipart/form-data"
                  method="post" class="form-horizontal">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estabelecimento</h3>

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
                                <?= form_error('name', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Nome" id="name" name="name"
                                               value="<?= set_value('name', $establishment['Nome']) ?>" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-xs-12 col-sm-6">
                                <?= form_error('cnpj', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="cnpj">CNPJ:</label>
                                    <div class="col-sm-8">
                                        <input type="text" placeholder="CNPJ" id="cnpj" name="cnpj"
                                               class="form-control" required
                                               value="<?= set_value('cnpj', $establishment['CNPJ']) ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6  ">
                                <?= form_error('category', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="category">Categoria</label>
                                    <div class="col-sm-7">
                                        <select name="category" id="category" required class="form-control">
                                            <?php foreach ($categories as $category): ?>
                                                <option
                                                    value="<?= $category->CodCategoria ?>"><?= $category->Nome ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= form_error('photograp', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2 pull-left">
                                        <img alt="Foto estabelecimento" class="img-responsive img-md"
                                             src="<?= base_url(DIR_IMG) . "/" . $establishment['Foto'] ?>" id="imgE">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="photograph">Fotografia</label>
                                        <input id="photograph" name="photograp" type="file" accept="image/*"
                                               <?php if ($id == null){ ?>required <?php } ?>
                                               onchange="loadFile(event)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-offset-2 col-sm-10">
                                <?= form_error('description', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <label class="control-label" for="description">Descrição:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div id="toolbar" style="display: none;">
                                            <div class="btn-group">
                                                <button data-wysihtml-command="bold" class="btn btn-default"
                                                        type="button"><i class="fa fa-bold"></i></button>
                                                <button data-wysihtml-command="italic" class="btn btn-default"
                                                        type="button"><i class="fa fa-italic"></i></button>
                                            </div>
                                            <!--                                            <div class="btn-group">-->
                                            <!--                                                <button data-wysihtml-command="alignLeftStyle" class="btn btn-default"-->
                                            <!--                                                        type="button"><i class="fa fa-align-left"></i></button>-->
                                            <!--                                                <button data-wysihtml-command="alignCenterStyle" class="btn btn-default"-->
                                            <!--                                                        type="button"><i class="fa fa-align-center"></i></button>-->
                                            <!--                                                <button data-wysihtml-command="alignRightStyle" class="btn btn-default"-->
                                            <!--                                                        type="button"><i class="fa fa-align-right"></i></button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                <textarea name="description" id="description" style="width: 100%"
                                          rows="5"
                                          required><?= set_value('description', $establishment['Descricao']) ?></textarea>
                            </div>
                        </div>

                    </div>


                </div>

                <?php $this->load->view('admin/layout/fragmentos/box_localizacao') ?>
                <button class="btn btn-block btn-success btn-lg" type="submit" value="cadastro">Cadastar</button>
            </form>
        </section>

    </div>

    <!--    Créditos-->
    <?php $this->load->view('admin/layout/credits') ?>

</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>
<script src="<?= base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>"></script>

<script src="<?= base_url('assets/plugins/wysihtml/wysihtml.js') ?>"></script>
<script src="<?= base_url('assets/plugins/wysihtml/wysihtml.all-commands.js') ?>"></script>
<script src="<?= base_url('assets/plugins/wysihtml/wysihtml.toolbar.js') ?>"></script>
<script src="<?= base_url('assets/plugins/wysihtml/advanced.js') ?>"></script>

<script>
    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('imgE');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    $(document).ready(function () {
        $("#cnpj").inputmask("99.999.999/9999-99");
        $("#zip_code").inputmask("99999-999");
    });

    var editor = new wysihtml.Editor("description", {
        toolbar: "toolbar",
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#street").val("");
        $("#neighborhood").val("");
        $("#city").val("");
        $("#state").val("");
    }

    //Quando o campo cep perde o foco.
    $("#zip_code").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#street").val("...");
                $("#neighborhood").val("...");
                $("#city").val("...");
                $("#state").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#street").val(dados.logradouro);
                        $("#neighborhood").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });


</script>

</body>
</html>
