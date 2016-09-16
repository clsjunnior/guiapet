<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrar</title>
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?=site_url()?>"><b>Guia</b>Pet</a>
    </div>

    <div class="register-box-body">
        <!--        <p class="login-box-msg">-->
        <h2 class="text-center" data-toggle="collapse" href="#bemVindoCll" aria-expanded="false" style="cursor: pointer">
            Cadastro
        </h2>
        <!--        </p>-->
        <p class="collapse" id="bemVindoCll">
            Bem vindo! <br>
            Para se cadastrar é simples, com apenas alguns dados dados básicos você já será um usuario do
            <b>Guia Pet</b> e poderá desfrutar de diversas vantagens que não é possivel como visitante.
        </p>

        <form action="<?=site_url('registrar')?>" method="post">
            <div class="form-group">
                <?=form_error('nome', '<label class="control-label text-red" for="nome">', '</label><br>')?>
                <label for="nome">*Nome completo:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="nome" class="form-control" name="nome" value="<?=set_value('nome')?>" required>
                </div>
            </div>

            <div class="form-group">
                <?=form_error('sexo', '<label class="control-label text-red" for="sexo">', '</label><br>')?>
                <div class="row">
                    <div class="col-xs-2">
                        <label for="sexo">*Sexo:</label>
                    </div>
                    <div class="col-xs-5">
                        <label>
                            <input type="radio" value="M" name="sexo" <?=set_radio('sexo', 'M', TRUE)?>> Maculino
                        </label>
                    </div>
                    <div class="col-xs-5">
                        <label>
                            <input type="radio" value="F" name="sexo" <?=set_radio('sexo', 'F')?>> Feminino
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?=form_error('email', '<label class="control-label text-red" for="email">', '</label><br>')?>
                <label for="email">*E-mail:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" id="email" class="form-control" name="email" value="<?=set_value('email')?>" required>
                </div>
            </div>
            <div class="form-group">
                <?=form_error('emailc', '<label class="control-label text-red" for="emailc">', '</label><br>')?>
                <label for="emailc">*Confirma o e-mail:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" id="emailc" class="form-control" name="emailc" required>
                </div>
            </div>

            <div class="form-group">
                <?=form_error('login', '<label class="control-label text-red" for="login">', '</label><br>')?>
                <label for="login">*Login:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                    <input type="text" id="login" class="form-control" name="login" value="<?=set_value('login')?>" required>
                </div>
            </div>

            <div class="form-group">
                <?=form_error('senha', '<label class="control-label text-red" for="senha">', '</label><br>')?>
                <label for="sena">*Senha:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                    <input type="password" id="senha" class="form-control" name="senha" required>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
                </div>
            </div>
        </form>
        <p><b>*</b> Campo obrigatório</p>
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
