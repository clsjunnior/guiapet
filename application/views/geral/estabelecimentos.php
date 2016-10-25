<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Header-->
<?php $this->load->view('geral/layout/header') ?>
<body>
<div class="row">
    <div class="banner-inicio">
        <img src="<?= base_url('assets/third_party/logo/logo-branco.png') ?>">
    </div>
    <div class="sub-menu">
        <div class="container">
            <section>
                <div class="hi-icon-wrap hi-icon-effect-8">
                    <a href="#" data-id="iconVeterinario" class="hi-icon icon-veterinario iconBusca"></a>
                    <a href="#" data-id="iconPet" class="hi-icon icon-petshop iconBusca"></a>
                    <a href="#" data-id="iconHotel" class="hi-icon icon-hotel iconBusca"></a>
                    <a href="#" data-id="iconAdestrador" class="hi-icon icon-adestrador iconBusca"></a>
                    <a href="#" data-id="iconTaxi" class="hi-icon icon-taxi iconBusca"></a>
                    <a href="#" data-id="todos" class="hi-icon icon-localizacao iconBusca"></a>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <!-- owl carousel -->
        <h3>Pessoas na sua região também pesquisaram...</h3>
        <div class="col-lg-12 menu-recomendacoes owl-carousel owl-theme">
            <a class="label label-primary item">Recomendação 01</a>
            <a class="label label-primary item">Recomendação 02</a>
            <a class="label label-primary item">Recomendação 03</a>
            <a class="label label-primary item">Recomendação 04</a>
            <a class="label label-primary item">Recomendação 05</a>
            <a class="label label-primary item">Recomendação 06</a>
        </div>

    </div>
</div>
<div class="container">
    <div class="col-md-12">
        <hr style="margin-bottom: 20px;"/>
        <ol class="breadcrumb">
            <li><a href="../../">Inicio</a></li>
            <li class="active"> <?= $estabelecimento->EsNome ?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="<?= base_url(DIR_IMG . '/' . $estabelecimento->EsFoto) ?>" alt="...">
                <div class="caption">
                    <p><a href="#" class="btn btn-default my-btn btn-block btn-large" role="button"
                          style="color: #fff;">Realizar Avaliação!</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary panel-mod">
                <div class="panel-heading">
                    <h1 class="panel-title">Quem Somos!</h1>
                </div>
                <div class="panel-body">
                    <h3 style="margin-top:0px">Informações Uteis</h3>
                    <p>
                        <?= $estabelecimento->EsDescricao ?>
                    </p>
                    <hr style="margin-bottom: 10px;">
                    <h3 style="margin-top:0px">Contatos</h3>
                    <p>
                        <?= $estabelecimento->CoTelefonePrincipal ?> / <?= $estabelecimento->CoTelefoneSecundario ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary panel-mod">
                <div class="panel-heading">
                    <h1 class="panel-title">Onde Estamos?!</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <div id="mapaEs"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="well well-lg">
                            <p style="font-size: 1.3em">
                                Estamos localizados na rua <strong> <?= $estabelecimento->LoRua ?>
                                    , <?= $estabelecimento->LoNumero ?> </strong> no bairro
                                <strong> <?= $estabelecimento->LoBairro ?> </strong> na cidade de
                                <strong> <?= $estabelecimento->LoCidade ?>/<?= $estabelecimento->LoEstado ?></strong>
                                <br> CEP: <strong> <?= $estabelecimento->LoCep ?> </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary panel-mod">
                <div class="panel-heading">
                    <h1 class="panel-title">Deixe seu comentário!!</h1>
                </div>
                <div class="panel-body">
                    <div id="disqus_thread"></div>
                </div>
            </div>
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
<script id="dsq-count-scr" src="//guiadopet.disqus.com/count.js" async></script>
<script>

    var marker;

    function initMap() {
        var map = new google.maps.Map(document.getElementById('mapaEs'), {
            zoom: 16,
            center: {lat: -21.673253, lng: -49.747381},
            scrollwheel: false,
            styles: [{
                "featureType": "landscape.man_made",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#e3e3e2"}]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{"visibility": "on"}, {"color": "#bfccde"}]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.attraction",
                "elementType": "all",
                "stylers": [{"visibility": "simplified"}]
            }, {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.government",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi.medical",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi.park",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#c8de8f"}]
            }, {
                "featureType": "poi.place_of_worship",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.school",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi.sports_complex",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [{"hue": "#ff0000"}, {"saturation": -100}, {"lightness": 99}]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [{"color": "#514e4e"}, {"lightness": 54}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#767676"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{"saturation": 43}, {"lightness": -11}, {"color": "#6286b8"}]
            }]
        });
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconVet.png"
        };
        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            icon: icone,
            animation: google.maps.Animation.DROP,
            position: {lat: <?=$estabelecimento->LoLatitude ?>, lng: <?=$estabelecimento->LoLongitude;?>}
        });
        map.setCenter(marker.getPosition());
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    initMap();


    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });


    /*
     var disqus_config = function () {
     this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
     this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
     };
     */
    (function () { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = '//guiadopet.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();


</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
        Disqus.</a></noscript>
</body>
</html>