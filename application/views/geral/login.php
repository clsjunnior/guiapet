<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/fonts/font-awesome.min.css')?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/fonts//ionicons.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/AdminLTE.css')?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-page, .register-page {
            background: #0b2646;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?= site_url() ?>">
            <img src="<?= base_url('assets/third_party/logo/logo-branco.png') ?>"
                 style="width: 90%; margin-bottom: 20px;">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?=$this->session->flashdata('login')?>
        <p class="login-box-msg">Faça o login para começar sua sessão</p>
        <form action="<?=site_url('login')?>" method="post">
            <div class="form-group has-feedback">
                <?=form_error('login', '<label class="control-label text-red" for="login">', '</label>')?>
                <input type="text" class="form-control" placeholder="Login" name="login" value="<?=set_value('login')?>" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?=form_error('senha', '<label class="control-label text-red" for="senha">', '</label>')?>
                <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a href="<?=site_url('registrar')?>" class="text-center">Registrar</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('assets/js/bootstrap.js')?>"></script>

</body>
</html>
