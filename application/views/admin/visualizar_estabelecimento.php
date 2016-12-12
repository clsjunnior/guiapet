<!--Header-->
<?php $this->load->view('admin/layout/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap_tagsinput/bootstrap-tagsinput.css') ?>"/>

<link rel="stylesheet" href="<?= base_url('assets/plugins/dropzone-4.3.0/dropzone.css') ?>"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
<style>
    .icon-github {
        background: no-repeat url('../img/github-16px.png');
        width: 16px;
        height: 16px;
    }

    .bootstrap-tagsinput {
        width: 100%;
    }

    .accordion {
        margin-bottom: -3px;
    }

    .accordion-group {
        border: none;
    }

    .twitter-typeahead .tt-query,
    .twitter-typeahead .tt-hint {
        margin-bottom: 0;
    }

    .twitter-typeahead .tt-hint {
        display: none;
    }

    .tt-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        list-style: none;
        font-size: 14px;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
        cursor: pointer;
    }

    .tt-suggestion {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.428571429;
        color: #333333;
        white-space: nowrap;
    }

    .tt-suggestion:hover,
    .tt-suggestion:focus {
        color: #ffffff;
        text-decoration: none;
        outline: 0;
        background-color: #428bca;
    }
</style>

<div class="wrapper">

    <!--    Barra de cima-->
    <?php $this->load->view('admin/layout/header_menu') ?>

    <!--    Menu da esquerda-->
    <?php $this->load->view('admin/layout/left_menu') ?>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <?= $estabelecimento->EsNome ?>
                <small><?= $estabelecimento->CaNome ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> Inicio</a></li>
                <li><a href="<?= site_url('dashboard/estabelecimentos') ?>">Estabelecimentos</a></li>
                <li class="active">Visualizar</li>
            </ol>
        </section>


        <section class="content">

            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Estabelecimento</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <img src="<?= base_url(DIR_IMG) . '/' . $estabelecimento->EsFoto ?>"
                                         class="img-responsive center-block" style="max-height: 200px">
                                </div>
                            </div>
                            <table class="table">
                                <tr>
                                    <td><b>Nome:</b></td>
                                    <td><?= $estabelecimento->EsNome ?></td>
                                </tr>
                                <tr>
                                    <td><b>CNPJ:</b></td>
                                    <td><?= mascara("##.###.###/####.##", $estabelecimento->EsCNPJ) ?></td>
                                </tr>
                            </table>
                            <p class="text-center"><b>Descrição:</b></p>
                            <div class="well"><?= $estabelecimento->EsDescricao ?></div>
                            <br>
                            <h4>Localizaçao</h4>
                            <table class="table">
                                <tr>
                                    <td><b>Estado:</b></td>
                                    <td><?= $estabelecimento->LoEstado ?></td>
                                </tr>
                                <tr>
                                    <td><b>Cidade:</b></td>
                                    <td><?= $estabelecimento->LoCidade ?></td>
                                </tr>
                                <tr>
                                    <td><b>CEP:</b></td>
                                    <td><?= $estabelecimento->LoCep ?></td>
                                </tr>
                                <tr>
                                    <td><b>Bairro:</b></td>
                                    <td><?= $estabelecimento->LoBairro ?></td>
                                </tr>
                                <tr>
                                    <td><b>Rua:</b></td>
                                    <td><?= $estabelecimento->LoRua ?></td>
                                </tr>
                                <tr>
                                    <td><b>Complemento:</b></td>
                                    <td><?= $estabelecimento->LoComplemento ?></td>
                                </tr>
                                <tr>
                                    <td><b>Número:</b></td>
                                    <td><?= $estabelecimento->LoNumero ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a role="button"
                               href="<?= site_url("dashboard/estabelecimentos/editar/" . $estabelecimento->EsCodEstabelecimento) ?>"
                               class="btn btn-block btn-primary">Alterar</a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Contatos</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <td><b>Telefone principal:</b></td>
                                    <td><?= $estabelecimento->CoTelefonePrincipal ?></td>
                                </tr>
                                <tr>
                                    <td><b>Telefone secundario:</b></td>
                                    <td><?= $estabelecimento->CoTelefoneSecundario ?></td>
                                </tr>
                                <tr>
                                    <td><b>Site:</b></td>
                                    <td><?= $estabelecimento->CoSite ?></td>
                                </tr>
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><?= $estabelecimento->CoEmail ?></td>
                                </tr>
                                <tr>
                                    <td><b>Facebook:</b></td>
                                    <td><?= $estabelecimento->CoFacebook ?></td>
                                </tr>
                                <tr>
                                    <td><b>Twitter:</b></td>
                                    <td><?= $estabelecimento->CoTwitter ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="box-footer">
                            <button role="button" data-toggle="modal" data-target="#modalContato"
                                    class="btn btn-block btn-primary">Alterar
                            </button>
                        </div>

                    </div>

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tags</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php foreach ($tags as $tag):?>
                                <?=$tag["Nome"].", "?>
                            <?php endforeach;?>
                        </div>

                        <div class="box-footer">
                            <button role="button" data-toggle="modal" data-target="#modalTags"
                                    class="btn btn-block btn-primary">Alterar
                            </button>
                        </div>

                    </div>

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Avaliações</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="small-box bg-aqua">
                                <div class="inner text-center">
                                    <p>Média</p>
                                    <h3><?= $avaliacao['media'] ?></h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Galeria</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php if (isset($galeria) && count($galeria) > 0): ?>
                                <?php foreach ($galeria as $foto): ?>
                                    <div class="col-xs-6 col-md-4">
                                        <img src="<?= base_url(DIR_IMG) . '/' . $foto['Arquivo'] ?>"
                                             class="img-responsive  img-thumbnail" style="max-height: 200px">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nenhuma imagem cadastrada em sua galeria.</p>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Carregar Imagem</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="<?= site_url('api/Galeria/Cadastrar/') ?>" class="dropzone"
                                  id="myAwesomeDropzone" enctype="multipart/form-data">
                                <input hidden name="EstabelecimentoCod"
                                       value="<?= $estabelecimento->EsCodEstabelecimento ?>">
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <!--    Créditos-->
    <?php $this->load->view('admin/layout/credits') ?>

</div>

<div class="modal fade" id="modalContato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url("dashboard/estabelecimentos/visualizar/$estabelecimento->EsCodEstabelecimento") ?>"
              class="form-horizontal" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Contatos</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="TelefonePrincipal" class="col-sm-4 control-label">Telefone principal:</label>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" id="TelefonePrincipal"
                                   value="<?= $estabelecimento->CoTelefonePrincipal ?>" name="TelefonePrincipal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="TelefoneSecundario" class="col-sm-4 control-label">Telefone secundario:</label>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" id="TelefoneSecundario"
                                   value="<?= $estabelecimento->CoTelefoneSecundario ?>" name="TelefoneSecundario">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Facebook" class="col-sm-4 control-label">Facebook:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Facebook"
                                   value="<?= $estabelecimento->CoFacebook ?>" name="Facebook"
                                   placeholder="/MeuEstabelecimento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Twitter" class="col-sm-4 control-label">Twitter:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Twitter"
                                   value="<?= $estabelecimento->CoTwitter ?>" name="Twitter"
                                   placeholder="@MeuEstabelecimento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Site" class="col-sm-4 control-label">Site:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Site" value="<?= $estabelecimento->CoSite ?>"
                                   name="Site"
                                   placeholder="www.meuestabelecimento.dominio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Email" class="col-sm-4 control-label">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="Email" value="<?= $estabelecimento->CoEmail ?>"
                                   name="Email"
                                   placeholder="meuestabelecimento@dominio">
                        </div>
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

<div class="modal fade" id="modalTags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url("dashboard/estabelecimentos/visualizar/$estabelecimento->EsCodEstabelecimento") ?>"
              class="form-horizontal" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tags</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Tags" class="col-sm-4 control-label">Tags:</label>
                        <div class="col-sm-8">
                            <input type="text" id="tagPut" class="form-control" name="tags" data-role="tagsinput" value="<?php foreach ($tags as $tag){ echo $tag["Nome"].", "; }?>">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="submit" value="tag" id="btnTag" class="btn btn-success">Alterar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>

<script src="<?= base_url('assets/plugins/bootstrap_tagsinput/bootstrap-tagsinput.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap_tagsinput/typeahead.bundle.js') ?>"></script>

<script src="<?= base_url('assets/plugins/dropzone-4.3.0/dropzone.js') ?>"></script>

<script>

    var listaTags = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '<?=site_url("api/Tag/buscaTag/esta")?>',
            filter: function (list) {
                return $.map(list, function (tag) {
                    return {name: tag};
                });
            }
        }
    });
    listaTags.initialize();

    $('#tagPut').tagsinput({
        tagClass: 'label label-primary',
        trimValue: false,
        typeaheadjs: {
            name: 'listaTags',
            displayKey: 'name',
            valueKey: 'name',
            source: listaTags.ttAdapter()
        }
    });
</script>
</body>
</html>
