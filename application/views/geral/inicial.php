<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Header-->
	<?php $this->load->view('geral/layout/header') ?>
<body>
	<div class="row">
		<div class="banner-inicio">
			<img src="<?=base_url('assets/third_party/logo/logo-branco.png')?>">
		</div>
		<div class="sub-menu">
			<div class="container">
				<section>
					<div class="hi-icon-wrap hi-icon-effect-8">
						<a href="#" class="hi-icon icon-veterinario"></a>
						<a href="#" class="hi-icon icon-adestrador"></a>
						<a href="#" class="hi-icon icon-petshop"></a>
						<a href="#" class="hi-icon icon-hotel"></a>
						<a href="#" class="hi-icon icon-taxi"></a>
						<a href="#" class="hi-icon icon-localizacao"></a>
					</div>
				</section>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<!-- owl carousel -->
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
	<div class="row">
		<div class="col-lg-3 col-md-4 col-xs-12 menu-lateral">

		</div>
		<div class="col-lg-9 col-md-8 col-xs-12" style="padding: 0px">
			<div id="map"></div>

		</div>
	</div>
	<?php $this->load->view('geral/layout/scripts') ?>
	<script>
		function initMap() {
			// Create a map object and specify the DOM element for display.
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -21.673391, lng: -49.747130},
				scrollwheel: false,
				zoom: 8
			});
		}

		$('.owl-carousel').owlCarousel({
			loop:false,
			margin:10,
			nav:false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:6
				}
			}
		})
	</script>
</body>
</html>