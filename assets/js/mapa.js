/**
 * Created by Windows 10 on 07/09/2016.
 */

window.initMap = function initMap() {

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: -21.673391, lng: -49.747130},
        scrollwheel: false,
        zoom: 16,
        styles: [{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#e3e3e2"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#bfccde"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#c8de8f"}]},{"featureType":"poi.place_of_worship","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#514e4e"},{"lightness":54}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":43},{"lightness":-11},{"color":"#6286b8"}]}]

    });

    displayMarkers(map);

};


var pontos = [
    {
        lat: -21.672274,
        lng: -49.752713,
        nome: "Clinica 01",
        descricao: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin vel nulla sed tempus. Vestibulum sodales eros ac odio sagittis, ac suscipit magna mattis. Etiam ultricies, sapien sed rutrum..."
    },
    {
        lat: -21.662274,
        lng: -49.742713,
        nome: "Clinica 02",
        descricao: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin vel nulla sed tempus. Vestibulum sodales eros ac odio sagittis, ac suscipit magna mattis. Etiam ultricies, sapien sed rutrum dignissim, diam turpis mollis leo, vitae finibus nunc sem ut dolor. Fusce vehicula venenatis mi quis venenatis."
    }
];


function displayMarkers(map){

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
    // Loop que vai estruturar a informação contida em pontos
    // para que a função createMarker possa criar os marcadores
    for (var i = 0; i < pontos.length; i++){

        var latlng = new google.maps.LatLng(pontos[i].lat, pontos[i].lng);
        var nome = pontos[i].nome;
        var descricao = pontos[i].descricao;

        createMarker(latlng, nome, descricao, map, infoWindow);

        // Os valores de latitude e longitude do marcador são adicionados à
        // variável bounds
        bounds.extend(latlng);
    }

    // Depois de criados todos os marcadores
    // a API através da sua função fitBounds vai redefinir o nível do zoom
    map.fitBounds(bounds);
}

// Função que cria os marcadores e define o conteúdo de cada Info Window.
function createMarker(latlng, nome, descricao, map, infoWindow){
    var icone = {
        url: 'assets/third_party/iconMaps/IconVet.png',
    };
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: icone,
        title: nome,
        animation: google.maps.Animation.DROP
    });

    // Evento que dá instrução à API para estar alerta ao click no marcador.
    // Define o conteúdo e abre a Info Window.
    google.maps.event.addListener(marker, 'click', function() {

        // Variável que define a estrutura do HTML a inserir na Info Window.
        var conteudo = '<div id="iw-container">' +
        '<div class="iw-title">'+ nome +'</div>' +
        '<div class="iw-content">' +
        '<div class="iw-subTitle">Clinica Veterinária</div>' +
        '<img src="assets/third_party/img/img01.jpg">' +
        '<p>'+ descricao +'<a href="#">Saiba Mais</a></p><hr/>' +
            '<div class="iw-subTitle">Contatos</div>' +
            '<p style="margin-top:5px; "><strong><span class="glyphicon glyphicon-phone" style="margin-right: 5px;" aria-hidden="true"></span></strong> (014) 99882-1015 <br/>'+
            '<strong><span class="glyphicon glyphicon-phone-alt" style="margin-right: 5px;" aria-hidden="true"></span></strong> (014) 3533-2323 </p>'+
            '<button type="button" class="btn btn-default fa-margin" data-toggle="tooltip" data-placement="bottom" title="Site"> <span class="fa fa-external-link"></span> </button>'+
            '<button type="button" class="btn btn-default fa-margin" data-toggle="tooltip" data-placement="bottom" title="Facebook"> <span class="fa fa-facebook"></span> </button>'+
            '<button type="button" class="btn btn-default fa-margin" data-toggle="tooltip" data-placement="bottom" title="Instagram"> <span class="fa fa-instagram"></span> </button>'+
            '<hr/>'+
        '<a href="#" class="btn btn-primary my-btn btn-block">Conheça!!</a>'+
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






