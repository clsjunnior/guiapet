<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Header-->
<?php $this->load->view('geral/layout/header') ?>
<body>
<!-- loader -->
<div class="loader">
    <div class="loader-inner ball-triangle-path">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- fim loader -->
<div class="row">
    <div class="banner-inicio">
        <img src="<?=base_url('assets/third_party/logo/logo-branco.png')?>">
    </div>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?= site_url()?>"><span class="fa fa-map-marker" style="margin-right: 5px;"></span> Mapa</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= site_url('contato')?>"><span class="fa fa-phone" style="margin-right: 5px;"></span> Contato</a></li>
                    <?php if (getSesUser(['Login'])): ?>
                        <li><a href="<?= site_url('dashboard') ?>"><span class="fa fa-user"
                                                                         style="margin-right: 5px;"></span> <?= getSesUser(['Login']) ?>
                            </a></li>
                        <input type="hidden" value="<?= getSesUser(['CodUsuario']) ?>" id="verificaUser"/>
                    <?php else: ?>
                        <li><a href="<?= site_url('dashboard') ?>"><span class="fa fa-lock"
                                                                         style="margin-right: 5px;"></span>
                                Login</a></li>
                        <input type="hidden" value="null" id="verificaUser"/>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="seperator"><i class="fa fa-flag"></i></div>
        <h1 style="text-align: center; margin-bottom: 30px;">Dúvidas, sugestões ou propostas, preencha os campos abaixo.</h1>
        <div class="seperator"><i class="fa fa-flag"></i></div>
        <div class="col-sm-12 col-md-12">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mensagem</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-lg my-btn btn-block" style="margin-top: 20px; margin-bottom: 30px">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-12">

        </div>
    </div>
</div>
<!-- FOOTER -->

<footer>
    <div class="container">
        <p class="pull-right"><a href="#">Topo</a></p>
        <p>&copy; 2016 Guia do Pet, Todos os direitos reservados.</p>
    </div>
</footer>

<?php $this->load->view('geral/layout/scripts') ?>


<script>

</script>
</body>
</html>