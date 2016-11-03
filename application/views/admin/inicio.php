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
                Inicio
                <small>Página principal</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Inicio</li>
            </ol>
        </section>


        <section class="content">


            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bem Vindo!</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>
                        Seja bem vindo <?= getSesUser(['Nome']) ?>!
                    </p>
                    <p>Atualmente você é <b><?= getSesPermissao(['Nome']) ?></b>.</p>
                </div>

            </div>

        </section>

    </div>

    <!--    Créditos-->
    <?php $this->load->view('admin/layout/credits') ?>

</div>

<!--Js e bibliotecas-->
<?php $this->load->view('admin/layout/footer') ?>

</body>
</html>
