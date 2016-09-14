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

            <form action="<?= site_url('dashboard/estabelecimentos/editar') ?>" enctype="multipart/form-data" method="post" class="form-horizontal">
                <input type="text" hidden value="<?=$establishment['id']?>" name="id">
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
                                               value="<?= set_value('name', $establishment['name']) ?>" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= form_error('website', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="website">Site:</label>
                                    <div class="col-sm-10">
                                        <input type="url" placeholder="Site" id="website" name="website"
                                               value="<?= set_value('website', $establishment['website']) ?>"
                                               class="form-control">
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
                                        <input type="tel" placeholder="Telefone" id="tel" name="tel"
                                               class="form-control"
                                               value="<?= set_value('tel', $establishment['tel']) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?= form_error('cnpj', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="cnpj">CNPJ:</label>
                                    <div class="col-sm-8">
                                        <input type="text" placeholder="CNPJ" id="cnpj" name="cnpj"
                                               class="form-control" required
                                               value="<?= set_value('cnpj', $establishment['cnpj']) ?>">
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
                                        <input id="photograph" name="photograp" type="file" accept="image/*" required
                                               onchange="loadFile(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4  ">
                                <?= form_error('category', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                <label for="category">Categoria</label>
                                <select name="category" id="category" required class="form-control">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
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
                                            <div class="btn-group">
                                                <button data-wysihtml-command="alignLeftStyle" class="btn btn-default"
                                                        type="button"><i class="fa fa-align-left"></i></button>
                                                <button data-wysihtml-command="alignCenterStyle" class="btn btn-default"
                                                        type="button"><i class="fa fa-align-center"></i></button>
                                                <button data-wysihtml-command="alignRightStyle" class="btn btn-default"
                                                        type="button"><i class="fa fa-align-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="description" id="description" style="width: 100%"
                                          rows="5" required><?= set_value('description', $location['description']) ?></textarea>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Localização</h3>

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
                            <div class="col-xs-12 col-sm-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" placeholder="Latitude" id="latitude" name="latitude"
                                               class="form-control" disabled required
                                               value="<?= set_value('latitude', $location['latitude']) ?>">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" placeholder="Longitude" id="longitude" name="longitude"
                                               class="form-control" disabled required
                                               value="<?= set_value('longitude', $location['longitude']) ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p id="msg" class="text-center text-red"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="height: 300px">
                                        <div id="mapa" class="no-fl" style="height: 100%; width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <?= form_error('city', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="city">Cidade:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="Cidade" id="city" name="city"
                                                       class="form-control" required
                                                       value="<?= set_value('city', $location['city']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <?= form_error('state', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="state">Estado:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="Estado" id="state" name="state"
                                                       class="form-control" required
                                                       value="<?= set_value('state', $location['state']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= form_error('street', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-xs-2 control-label" for="street">Endereço:</label>
                                            <div class="col-xs-10">
                                                <input type="text" placeholder="Endereço" id="street" name="street"
                                                       class="form-control" required
                                                       value="<?= set_value('street', $location['street']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= form_error('neighborhood', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-xs-2 control-label" for="neighborhood">Bairro:</label>
                                            <div class="col-xs-10">
                                                <input type="text" placeholder="Bairro" id="neighborhood"
                                                       name="neighborhood"
                                                       class="form-control" required
                                                       value="<?= set_value('neighborhood', $location['neighborhood']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <?= form_error('zip_code', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="zip_code">CEP:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="CEP" id="zip_code" name="zip_code"
                                                       class="form-control" required
                                                       value="<?= set_value('zip_code', $location['zip_code']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <?= form_error('number', '<div class="row"><div class="col-sm-offset-4 col-sm-8"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="number">Número:</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="Número" id="number" name="number"
                                                       class="form-control"
                                                       value="<?= set_value('number', $location['number']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= form_error('complement', '<div class="row"><div class="col-sm-offset-2 col-sm-10"><p class="text-red">', '</p></div></div>') ?>
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <label class="control-label" for="complement">Complemento:</label>
                                            </div>
                                        </div>
                                        <textarea name="complement" id="complement" style="width: 100%"
                                                  rows="5"><?= set_value('complement', $location['complement']) ?></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
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

<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_KEY ?>&callback=initMap" async defer></script>

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
        $("#tel").inputmask("(999) 99999-9999");
        $("#cnpj").inputmask("99.999.999/9999-99");
        $("#zip_code").inputmask("99999-999");


    });

    var editor = new wysihtml.Editor("description", {
        toolbar: "toolbar",
    });

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('mapa'), {
            center: {lat: 0, lng: 0},
            zoom: 17
        });
        var marker = new google.maps.Marker({map: map});

        // Verifica o suporte do navegador
        if (navigator.geolocation) {
            // Tenta pegar a localização atual
            navigator.geolocation.getCurrentPosition(function (position) {
                // Atribui as localizações encontradas
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Mostra no mapa a localização
                marker.setPosition(pos);
                marker.setTitle("Meu estabelecimento está aqui!");
                map.setCenter(pos);
                document.getElementById("latitude").value = position.coords.latitude;
                document.getElementById("longitude").value = position.coords.longitude;

                // Se não conseguir obter a localização
            }, function () {
                exibirErro("Não foi possivel obter sua localização. Navege até o local de seu estabelecimento");
            });
            // Se o navegador não suportar geolocalização
        } else {
            exibirErro("Seu navegador não suporta tecnologia de geolocalização. Navege até o local de seu estabelecimento");

        }

        google.maps.event.addListener(map, "click", function (event) {
            // place a marker
            marker.setPosition(event.latLng);
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();

        });
    }

    function exibirErro(msg) {
        $("#msg").html(msg);
//        info.setContent(browserHasGeolocation ?
//            'Erro: Falha ao obter a localização' :
//            'Erro: Seu navegador não suporta geolocalização');
    }

</script>

</body>
</html>
