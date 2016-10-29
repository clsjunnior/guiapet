<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Endereço<small>(Localização)</small></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <div id="mapa" class="embed-responsive-item"></div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="latitude">Latitude:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" readonly id="latitude" name="latitude"
                                       value="<?= set_value('latitude', $location['Latitude']) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="longitude">Longitude:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" readonly id="longitude" name="longitude"
                                       value="<?= set_value('longitude', $location['Longitude']) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="state">Estado:</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Estado" maxlength="2" id="state" name="state"
                                       value="<?= set_value('state', $location['Estado']) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="city">Cidade:</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Cidade" id="city" name="city" value="<?=set_value('city',$location['Cidade'])?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="zip_code">Cep:</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Cep" id="zip_code" name="zip_code" value="<?=set_value('zip_code',$location['Cep'])?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="number">Número:</label>
                            <div class="col-sm-8">
                                <input type="number" placeholder="Nº" id="number" name="number"
                                       value="<?= set_value('number', $location['Numero']) ?>"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="street">Rua:</label>
                            <div class="col-xs-10">
                                <input type="text" placeholder="Endereço" id="street" name="street" value="<?=set_value('street',$location['Rua'])?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="neighborhood">Bairro:</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Bairro" id="neighborhood" name="neighborhood" value="<?=set_value('neighborhood',$location['Bairro'])?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="complement">Complemento:</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Complemento" id="complement" name="complement" value="<?=set_value('complement',$location['Complemento'])?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>

    <?php if(uri_string() == "dashboard/perfil"):?>
    <div class="box-footer text-right">
        <button class="btn  btn-info btn-sm" type="submit" value="localizacao" id="localizacao"
                name="submit">Alterar
        </button>
    </div>
    <?php endif;?>


</div>


<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('mapa'), {
            center: {lat: -21.673391, lng: -49.747130},
            zoom: 17,
            styles: [{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#e3e3e2"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#bfccde"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#c8de8f"}]},{"featureType":"poi.place_of_worship","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#514e4e"},{"lightness":54}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":43},{"lightness":-11},{"color":"#6286b8"}]}]
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
                $("#latitude").attr("value", position.coords.latitude);
                $("#latitude").val(position.coords.latitude);

                $("#longitude").attr("value", position.coords.longitude);
                $("#longitude").val(position.coords.longitude);

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

            $("#latitude").attr("value", event.latLng.lat());
            $("#latitude").val(event.latLng.lat());

            $("#longitude").attr("value", event.latLng.lng());
            $("#longitude").val(event.latLng.lng());

        });
    }

    function exibirErro(msg) {
        $("#msg").html(msg);
//        info.setContent(browserHasGeolocation ?
//            'Erro: Falha ao obter a localização' :
//            'Erro: Seu navegador não suporta geolocalização');
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_KEY ?>&callback=initMap" async defer></script>