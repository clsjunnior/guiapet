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
	<div class="row">
		<div class="col-lg-3 col-md-4 col-xs-12 menu-lateral">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Opções de Pesquisa</h3>
				</div>
				<div class="panel-body">
					<form>
						<div class="form-group">
							<label for="categoria">Estabelecimentos por categoria</label>
							<select class="form-control" id="categoria">
								<option>Selecione uma Categoria</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
						<div class="form-group">
							<label for="estabelecimentos">Estabelecimentos</label>
							<input type="text" id="estabelecimentos" class="form-control" placeholder="Informe o nome do estabelecimento">
						</div>
						<div class="form-group">
							<label for="tag">Tag - Palavras-Chave</label>
							<select class="form-control" id="tag" multiple="multiple">
								<option value="tag1">tag1</option>
								<option value="tag2">tag2</option>
							</select>
						</div>
						<div class="form-group">
							<label for="estabelecimentos">Avaliação</label>
							<input type="hidden" class="rating" data-fractions="2"/>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 col-xs-12" style="padding: 0px">
			<div id="map"></div>
		</div>
	</div>
	<?php $this->load->view('geral/layout/scripts') ?>
	<script>
		window.initMap = function initMap() {
			// Create a map object and specify the DOM element for display.
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -21.673391, lng: -49.747130},
				scrollwheel: false,
				zoom: 8
			});
		};

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

		$("#tag, #categoria").select2({
			placeholder: 'Selecione uma Opção'
		});
	</script>
</body>
</html>