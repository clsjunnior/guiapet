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
                                <tr>
                                    <td><b>Data de criação:</b></td>
                                    <td><?= date('d/m/Y', strtotime($estabelecimento->EsCriadoEm)) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Data da ultima modificação:</b></td>
                                    <td><?= date('d/m/Y', strtotime($estabelecimento->EsAtualizadoEm)) ?></td>
                                </tr>
                            </table>
                            <p class="text-center"><b>Descrição:</b></p>
                            <div class="well"><?= $estabelecimento->EsDescricao ?></div>
                        </div>
                        <div class="box-footer">
                            <a role="button" class="btn btn-block btn-primary">Alterar</a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Localização</h3>
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
                            <a role="button" class="btn btn-block btn-primary">Alterar</a>
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
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Telefone secundario:</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Site:</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Facebook:</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Twitter:</b></td>
                                    <td></td>
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
                            Start creating your amazing application!
                        </div>

                        <div class="box-footer">
                            <a role="button" class="btn btn-block btn-primary">Alterar</a>
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
                            Start creating your amazing application!
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
                            Start creating your amazing application!
                        </div>

                        <div class="box-footer">
                            Footer
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
              class="form-horizontal">
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
                            <input type="tel" class="form-control" id="TelefonePrincipal" name="TelefonePrincipal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="TelefoneSecundario" class="col-sm-4 control-label">Telefone secundario:</label>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" id="TelefoneSecundario" name="TelefoneSecundario">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Facebook" class="col-sm-4 control-label">Facebook:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Facebook" name="Facebook"
                                   placeholder="/MeuEstabelecimento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Twitter" class="col-sm-4 control-label">Twitter:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Twitter" name="Twitter"
                                   placeholder="@MeuEstabelecimento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Site" class="col-sm-4 control-label">Site:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Site" name="Site"
                                   placeholder="www.meuestabelecimento.dominio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Email" class="col-sm-4 control-label">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="Email" name="Email"
                                   placeholder="meuestabelecimento@dominio">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success">Alterar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>

</body>
</html>
