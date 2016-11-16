/**
 * Created by Windows 10 on 07/09/2016.
 */
// busca por categoria - icones

var url_busca = site_url + "/api/estabelecimentos/buscaTotal/";
$('.iconBusca').on('click', function () {
    var valor = $(this).attr("data-id");

    if (valor == "iconVeterinario") {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/1";
        initMap(url_busca);
    } else if (valor == "iconPet") {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/2";
        initMap(url_busca);
    } else if (valor == "iconHotel") {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/3";
        initMap(url_busca);
    } else if (valor == "iconAdestrador") {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/4";
        initMap(url_busca);
    } else if (valor == "iconTaxi") {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/5";
        initMap(url_busca);
    } else {
        url_busca = site_url + "/api/estabelecimento/buscaTotal/";
        initMap(url_busca);
    }

});
// busca por categoria - option
$('#categoriaEs').on('change', function () {
    var categoria = $(this).val();
    if (categoria == 1) {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/1";
        initMap(url_busca);
    } else if (categoria == 2) {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/2";
        initMap(url_busca);
    } else if (categoria == 3) {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/3";
        initMap(url_busca);
    } else if (categoria == 4) {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/4";
        initMap(url_busca);
    } else if (categoria == 5) {
        url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoCategoria/5";
        initMap(url_busca);
    } else {
        url_busca = site_url + "/api/estabelecimento/buscaTotal/";
        initMap(url_busca);
    }
});

// busca por nome de estabelecimento mas usando o id
$('#pesquisaEs').click(function () {
    var idEs = $('#estabelecimento-busca').attr('data-id-es');
    url_busca = site_url + "/api/estabelecimento/buscaEstabelecimentoId/" + idEs;
    initMap(url_busca);
});

// pesquisa por avaliacao
$('#avaliacao').change(function () {
    var nota = $(this).val();
    url_busca = site_url + "/api/avaliacao/buscaEsAvaliacao/" + nota;
    initMap(url_busca);
    //console.log(nota);
});

// pesquisa por tags
$('#pesquisaEsTag').click(function () {
    var tags = $('#tag').attr('data-tag-id');
    var tg = tags.replace(",", "-");
    url_busca = site_url + "/api/tagsEstabelecimento/buscatges/" + tg;
    initMap(url_busca);
    // melhorar para nao pesquisar tags em branco ou estabelecimentos sem tag
    
});

//obter localizao atual usuario
function initMapLocation() {
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: -21.673253, lng: -49.747381},
        zoom: 17
    });

    var infoWindow = new google.maps.InfoWindow({map: map});

    ModificaInfowindow(infoWindow);
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            $('.gm-style-iw').css("width", "250px");
            var conteudoLocation = '<div id="iw-container" style="width:250px !important; overflow: hidden">' +
                '<div class="iw-title"> Localização Atual</div>' +
                '<div class="iw-content">' +
                '<h3> Olá, você esta aqui!!</h3>' +
                '</div>' +
                '<div class="iw-bottom-gradient"></div>' +
                '</div>';

            // O conteúdo da variável iwContent é inserido na Info Window.
            infoWindow.setContent(conteudoLocation);
            map.setCenter(pos);
        }, function () {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

$('#btnLocalizacao').click(function () {
    initMapLocation();
});



function initMap(url_busca) {
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: -21.673253, lng: -49.747381},
        scrollwheel: false,
        zoom: 18,
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

    displayMarkers(map, url_busca);
}

initMap(url_busca);

/*function carregarPontos() {

 $.getJSON("api/estabelecimento/buscaEstabelecimentoCategoria/2", function( data ) {
 dados = '';
 var data = data.EsCategoria;
 $.each(data, function(index, value){
 dados += "{lat:"+data.lat+","+
 " long:"+data.long+"," +
 " nome:"+data.nome+"," +
 " descricao:"+data.descricao+"," +
 "},";
 });
 //console.log(dados);
 })
 .always(function() {
 // $('.load, .spinner').fadeIn('fast');
 //$('html').addClass('bloquear');
 })
 .done(function() {
 // $('.load, .spinner').fadeOut('fast'); //wow!
 //  $('html').removeClass('bloquear');
 console.log(dados);
 })
 .fail(function() {
 alert("Ops, ocorreu um erro. Tente novamente!");
 });
 }*/


function displayMarkers(map, url_busca) {

    // esta variável vai definir a área de mapa a abranger e o nível do zoom
    // de acordo com as posições dos marcadores
    var bounds = new google.maps.LatLngBounds();

    var infoWindow;
    infoWindow = new google.maps.InfoWindow({
        maxWidth: 350
    });


    // evento que fecha a infoWindow com click no mapa
    google.maps.event.addListener(map, 'click', function() {
        infoWindow.close();
    });

    ModificaInfowindow(infoWindow);

    $.getJSON(url_busca, function (pontos) {

        $.each(pontos, function (index, ponto) {
            var nenhumResultado = ponto.vazio;
            if (typeof(nenhumResultado) != "undefined") {
                swal({
                    title: 'Ops :(',
                    text: "Nenhum estabelecimento encontrado!",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#1c3e5e',
                    confirmButtonText: 'Tente outra vez!'
                }).then(function () {
                    url_busca = site_url + "/api/estabelecimento/buscaTotal/";
                    initMap(url_busca);
                });
            } else {
                var idEs = ponto.idEs;
                var categoria = ponto.categoria;
                var foto = ponto.foto;
                var latlng = new google.maps.LatLng(ponto.lat, ponto.long);
                var nome = ponto.nome;
                var descricao = ponto.descricao;
                //var tipoContato = ponto.tipoContato;
                //var contato = ponto.contato;
                createMarker(idEs, categoria, foto, latlng, nome, descricao, map, infoWindow);
                bounds.extend(latlng);
            }
        });

    });

    // Depois de criados todos os marcadores
    // a API através da sua função fitBounds vai redefinir o nível do zoom
    // Add a marker clusterer to manage the markers.
    map.fitBounds(bounds);
    // map.setCenter({lat: -21.673253, lng: -49.747381}); // centraliza depois q pesquisa
    // map.setZoom(14);
}

// Função que cria os marcadores e define o conteúdo de cada Info Window.
function createMarker(idEs, categoria, foto, latlng, nome, descricao, map, infoWindow) {

    if (categoria == "Clinica Veterinária") {
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconVet.png",
        };
    }
    else if (categoria == "Pet Shop") {
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconPet.png",
        };
    }
    else if (categoria == "Hoteis para Pet") {
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconHotel.png",
        };
    }
    else if (categoria == "Adestradores") {
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconAdestrador.png",
        };
    } else {
        var icone = {
            url: base_url + "assets/third_party/iconMaps/IconTaxi.png",
        };
    }


    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: icone,
        title: nome,
        animation: google.maps.Animation.DROP
    });

    map.setCenter(marker.getPosition()); // centraliza depois q pesquisa
    map.setZoom(16);


    google.maps.event.addListener(marker, 'click', function() {
        var url_tag = site_url + "/api/tagsEstabelecimento/buscaTagEs/" + idEs;

        $.getJSON(url_tag, function (resultados) {
            var tags = " ";
            $.each(resultados, function (index, resp) {
                var nenhumResultado = resp.vazio;
                if (typeof(nenhumResultado) != "undefined") {
                    tags += "Nenhuma Tag adicionada!";
                } else {
                    tags += '<a href="#">' + resp.tagNome + '</a> &#9702; ';
                }
            });
            $("#tagsInfowindow").html(tags);
        });

        var url_avaliacao = site_url + "/api/avaliacao/buscaAvaliacaoEs/" + idEs;
        $.getJSON(url_avaliacao, function (resultados) {
            var avaliacao = " ";
            $.each(resultados, function (index, resp) {

                if (resp.media == null) {
                    avaliacao += "Nenhuma avaliação realizada!";
                } else {
                    //avaliacao += "<b>" +resp.media + " estrelas!!</b>";
                    if (resp.media == 1)
                        avaliacao += "<span class='fa fa-star fa-2x'></span>";
                    else if (resp.media == 2)
                        avaliacao += "<span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span>";
                    else if (resp.media == 3)
                        avaliacao += "<span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span>";
                    else if (resp.media == 4)
                        avaliacao += "<span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span>";
                    else
                        avaliacao += "<span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span> <span class='fa fa-star fa-2x'></span>";
                }
            });
            $("#avaliacaoInfowindow").html(avaliacao);
        });  
        
        // Variável que define a estrutura do HTML a inserir na Info Window.
        var conteudo = '<div id="iw-container">' +
        '<div class="iw-title">'+ nome +'</div>' +
        '<div class="iw-content">' +
            '<div class="iw-subTitle">' + categoria + '</div>' +
            '<img src="' + base_url + 'assets/third_party/app/img/' + foto + '">' +
            '<hr/><p>' + descricao + '<br/><a href="#">Saiba Mais</a></p>' +
            '<div class="iw-subTitle">Palavras-Chave</div>' +
            '<div id="tagsInfowindow"></div>' +
            '<hr/>'+
            '<div class="iw-subTitle">Avaliação</div>' +
            '<div id="avaliacaoInfowindow"></div>' +
            '<hr/>' +
            '<a href="estabelecimento/' + idEs + '" class="btn btn-primary my-btn btn-block">Conheça!!</a>' +
        '<div class="iw-bottom-gradient"></div>' +
        '</div>';

        // O conteúdo da variável iwContent é inserido na Info Window.
        infoWindow.setContent(conteudo);

        // A Info Window é aberta.
        infoWindow.open(map, marker);
    });
}

function ModificaInfowindow(infowindow) {

    google.maps.event.addListener(infowindow, 'domready', function() {

        // Referência ao DIV que agrupa o fundo da infowindow
        var iwOuter = $('.gm-style-iw');

        /* Uma vez que o div pretendido está numa posição anterior ao div .gm-style-iw.
         * Recorremos ao jQuery e criamos uma variável iwBackground,
         * e aproveitamos a referência já existente do .gm-style-iw para obter o div anterior com .prev().
         */
        var iwBackground = iwOuter.prev();

        // Remover o div da sombra do fundo
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});

        // Remover o div de fundo branco
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Desloca a infowindow 115px para a direita
        iwOuter.parent().parent().css({left: '30px'});

        // Desloca a sombra da seta a 76px da margem esquerda
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 160px !important;'});

        // Desloca a seta a 76px da margem esquerda
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 160px !important;'});

        // Altera a cor desejada para a sombra da cauda
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': '#6286b8) 0px 1px 6px', 'z-index' : '1'});

        // Referência ao DIV que agrupa os elementos do botão fechar
        var iwCloseBtn = iwOuter.next();

        // Aplica o efeito desejado ao botão fechar
        iwCloseBtn.css({opacity: '1', right: '45px', top: '5px', width: '30px', height: '30px' , padding:'5px', 'border-radius': '100%'});

        // Se o conteúdo da infowindow não ultrapassar a altura máxima definida, então o gradiente é removido.
        if($('.iw-content').height() < 140){
            $('.iw-bottom-gradient').css({display: 'none'});
        }

        // A API aplica automaticamente 0.7 de opacidade ao botão após o evento mouseout. Esta função reverte esse evento para o valor desejado.
        iwCloseBtn.mouseout(function(){
            $(this).css({opacity: '1'});
        });
    });

}

