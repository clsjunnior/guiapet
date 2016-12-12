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
        <img src="<?= base_url('assets/third_party/logo/logo-branco.png') ?>">
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
                                                                         style="margin-right: 5px;"></span> Login</a>
                        </li>
                        <input type="hidden" value="null" id="verificaUser"/>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<div class="row">
    <div class="container">
        <!-- owl carousel -->
        <h3>Estabelecimentos com serviços semelhantes a esse!!</h3>
        <!--        <div class="col-lg-12 menu-recomendacoes owl-carousel owl-theme">-->
        <!--            <div id="recomendacaoEs" data-tags-id=""></div>-->
        <!--        </div>-->
        <div id="recomendacaoEs" class="owl-carousel menu-recomendacoes" data-tags-id="">
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
                <a class="fancybox" rel="gallery1" href="<?= base_url(DIR_IMG . '/' . $estabelecimento->EsFoto) ?>">
                    <img src="<?= base_url(DIR_IMG . '/' . $estabelecimento->EsFoto) ?>" alt="...">
                </a>
                <div class="caption">
                    <h3 style="text-align: center;"> <?= $estabelecimento->EsNome ?></h3>
                    <hr style="margin-bottom: 10px;">
                    <div class="avaliacaoEs" style="text-align: center; margin-top: 20px;">
                        <?php if (count($avaliacao['media'])): ?>
                            <label>Nossa media de Avaliações</label><br>
                            <?php if ($avaliacao['media'] == 1): ?>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                            <?php elseif ($avaliacao['media'] == 2): ?>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                            <?php elseif ($avaliacao['media'] == 3): ?>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                            <?php elseif ($avaliacao['media'] == 4): ?>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x avaliacaoNegativa'></span>
                            <?php else: ?>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                                <span class='fa fa-star fa-2x'></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <label style="color: darkred;">Nenhuma avaliação realizada, aproveite e nos avalie clicando
                                no botão abaixo!</label>
                        <?php endif; ?>
                    </div>
                    <hr style="margin-bottom: 10px;">
                    <p>
                        <a href="#" class="btn btn-default my-btn btn-block btn-large" data-toggle="modal"
                           data-target="#modalAvaliacao" role="button"
                           style="color: #fff;">Realizar Avaliação!</a>
                    </p>
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
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                        </span>
                        <?= $estabelecimento->CoTelefonePrincipal ?> / <?= $estabelecimento->CoTelefoneSecundario ?>
                    </p>
                    <p>
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                        </span> <?= $estabelecimento->CoEmail ?>
                    </p>
                    <p>
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-link fa-stack-1x fa-inverse"></i>
                        </span> <a href="<?= $estabelecimento->CoSite ?>"
                                   target="_blank"> <?= $estabelecimento->CoSite ?> </a>
                    </p>
                    <hr style="margin-bottom: 10px;">
                    <p>
                        <a href="http://www.facebook.com/<?= $estabelecimento->CoFacebook ?>"
                           style="margin-right: 5px;"><span class="fa fa-facebook-square fa-2x"></span></a>
                        <a href="http://www.twitter.com/<?= $estabelecimento->CoTwitter ?>"><span
                                class="fa fa-twitter-square fa-2x"></span></a>
                    </p>
                    <hr style="margin-bottom: 10px;">
                    <h3 style="margin-top:0px">Palavras-chave (Tags)</h3>
                    <p>
                    <div id="tagsEs" style="margin-top: 30px;"></div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <h3 style="margin-top:0px">Galeria de Imagens</h3>
            <hr style="margin-bottom: 10px;">
            <?php if (count($galeria)): ?>
                <div id="owl-galeria" class="owl-carousel owl-theme" style="margin-top: 20px;">
                <?php foreach ($galeria as $list): ?>
                    <div class="item">
                        <a class="fancybox" rel="gallery1" href="<?= base_url(DIR_IMG . '/' . $list['Arquivo']) ?>">
                            <img src="<?= base_url(DIR_IMG . '/' . $list['Arquivo']) ?>" alt="...">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <h3 style="margin-bottom: 30px;">Nenhuma imagem adicionada!</h3>
                <hr/>
            <?php endif; ?>
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
<!-- Modal -->
<div class="modal fade" id="modalAvaliacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Avaliar Estabelecimento!</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Quantas estrelas nós merecemos?</label><br>
                        <select id="avaliacao">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <?php if ($this->session->has_userdata('login')): ?>
                    <div class="form-group">
                        <button type="button" id="btnAvaliar" class="btn btn-primary">Salvar Avaliação</button>
                    </div>
                    <?php else: ?>
                        <h3 style="margin-bottom: 10px;">Necessário login para realizar avaliação!</h3>
                    <?php endif; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>
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

    $('#avaliacao').barrating({
        theme: 'fontawesome-stars'
    });

    /*enviar avaliacao*/
    $('#btnAvaliar').on('click', function () {
        var av = $("#avaliacao").val();
//        $.get(site_url + "/api/Avaliacao/avaliar/", <?//=$estabelecimento->EsCodEstabelecimento?>//+"/"+av+"", function( data ) {
//            console.log(data);
//        });
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/api/Avaliacao/avaliar/<?=$estabelecimento->EsCodEstabelecimento?>/" + av,
            dataType: "html",
            success: function (data) {
                //alert(data);
                if (data == "ok") {
                    swal({
                        title: 'Obrigado!!!',
                        text: "Avaliação realizada com Sucesso!",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1c3e5e',
                        confirmButtonText: 'Voltar'
                    }).then(function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: 'Ops :(',
                        text: "Erro ao realizar a avaliação!",
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#1c3e5e',
                        confirmButtonText: 'Tentar Novamente!'
                    }).then(function () {
                        window.location.reload();
                    });
                }
            },
            error: function (data) {
                alert(data);
            }
        });
    });


    //    $('.owl-carousel').owlCarousel({
    //        loop: false,
    //        margin: 10,
    //        nav: false,
    //        responsive: {
    //            0: {
    //                items: 1
    //            },
    //            600: {
    //                items: 3
    //            },
    //            1000: {
    //                items: 6
    //            }
    //        }
    //    });
    //    //
    //    $('.owl-galeria').owlCarousel({
    //        loop: false,
    //        margin: 10,
    //        nav: false,
    //        responsive: {
    //            0: {
    //                items: 1
    //            },
    //            600: {
    //                items: 3
    //            },
    //            1000: {
    //                items: 4
    //            }
    //        }
    //    });

    $("#owl-galeria").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]
    });

    /*busca tags do estabelecimento*/
    var url_tag = "../api/tagsEstabelecimento/buscaTagEs/" + <?=$estabelecimento->EsCodEstabelecimento?>;
    var id_tags = [];

    $.getJSON(url_tag, function (resultados) {

        var tags = " ";
        var cont = 0;
        $.each(resultados, function (index, resp) {
            var nenhumResultado = resp.vazio;

            if (typeof(nenhumResultado) != "undefined") {
                tags += "Nenhuma Tag adicionada!";
            } else {
                tags += '<span class="label label-primary label-tag">' + resp.tagNome + '</span>';
                id_tags.push(resp.TagCod);
                cont++;
            }
        });
        $("#tagsEs").html(tags);

        $("#recomendacaoEs").attr('data-tags-id', id_tags);
        var tagsSelecionadas = $('#recomendacaoEs').attr('data-tags-id');
        var tagsFormat = tagsSelecionadas.replace(/,/g, "-");
        var url_recomendacao = site_url + "/api/Estabelecimento/recomendacaoTags/" + tagsFormat + "";

        $.getJSON(url_recomendacao, function (resultados) {
            var result = " ";

            $.each(resultados, function (index, resp) {
                var href = site_url + "/estabelecimento/" + resp.CodEstabelecimento;
                result += '<a class="label label-primary item label-recomendacao" href="' + href + '">' + resp.Nome + '</a>';
            });
            // atribui no campo de tag
            $("#recomendacaoEs").html(result);
        });

        $("#recomendacaoEs").owlCarousel({
            jsonPath: url_recomendacao,
            jsonSuccess: customDataSuccess,
            items: cont, //10 items above 1000px browser width
            itemsDesktop: [1000, 6], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 4], // betweem 900px and 601px
            itemsTablet: [600, 2], //2 items between 600 and 0;
            itemsMobile: true
        });

        function customDataSuccess(data) {
            var content = "";
            for (var i in data) {
                var href = site_url + "/estabelecimento/" + data[i].CodEstabelecimento;
                var nome = data[i].Nome;

                content += '<a class="label label-primary label-recomendacao" href="' + href + '">' + nome + '</a>'
            }
            $("#recomendacaoEs").html(content);
        }

    });


    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
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