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
		<!--<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="navbar navbar-default">
				<a href="#" id="testeOff">Teste</a>
			</div>
		</div>-->
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
								<?php if(count($cat)):?>
									<?php foreach ($cat as $list):?>
										<option value="<?=$list['CodCategoria']?>"><?=$list['Nome']?></option>
									<?php endforeach;?>
								<?php else:?>
									<option value="0">Nenhuma categoria cadastrada</option>
								<?php endif;?>
							</select>
						</div>

						<div class="form-group">
							<label for="estabelecimentos">Estabelecimentos</label>
							<input type="text" id="estabelecimento-ajax" class="form-control" placeholder="Informe o nome do estabelecimento">
						</div>
						<div class="form-group">
							<label for="tag">Tag - Palavras-Chave</label>
							<select class="form-control" id="tag" multiple="multiple">
								<option value="tag1">tag1</option>
								<option value="tag2">tag2</option>
							</select>
						</div>
						<div class="form-group">
							<label>Avaliação</label><br>
							<select id="example">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="form-group">
							<label>Pesquisa por proximidade</label><br>
							<button class="btn btn-primary btn-lg my-btn">Ativar minha localização</button>
						</div>
					</form>
				</div>
			</div>
			<!--<div class="navmenu navmenu-default">
				<a class="navmenu-brand visible-md visible-lg" href="#">Project name</a>
				<ul class="nav navmenu-nav">
					<li class="active"><a href="./">Slide in</a></li>
					<li><a href="../navmenu-push/">Push</a></li>
					<li><a href="../navmenu-reveal/">Reveal</a></li>
					<li><a href="../navbar-offcanvas/">Off canvas navbar</a></li>
				</ul>
				<ul class="nav navmenu-nav">
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
						<ul class="dropdown-menu navmenu-nav">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
			</div>-->
		</div>
		<div class="col-lg-9 col-md-8 col-xs-12" style="padding: 0px">
			<div id="mapa"></div>
		</div>
		<div id="result"></div>
	</div>
	<!-- FOOTER -->

	<footer>
		<div class="container">
		<p class="pull-right"><a href="#">Topo</a></p>
		<p>&copy; 2016 Guia do Pet, Todos os direitos reservados.</p>
		</div>
	</footer>

	<?php $this->load->view('geral/layout/scripts') ?>


	<script>

		$('#testeOff').click(function () {
			$('.menu-lateral').offcanvas('toggle');
		});
		
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

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});

		$("#tag, #categoria").select2({
			placeholder: 'Selecione uma Opção'
		});

		/*Easy autocomplete para busca de estabelecimentos*/
		var pesquisaEasy = {

			url: function(phrase) {
//				return "api/countrySearch.php";
				return "<?php echo site_url(); ?>" + "/api/estabelecimento/busca";
			},

			getValue: function(element) {
				return element.nome;
			},

			ajaxSettings: {
				dataType: "json",
				method: "POST",
				data: {
					dataType: "json"
				}
			},

			preparePostData: function(data) {
				data.phrase = $("#estabelecimento-ajax").val();
				return data;
			},

			requestDelay: 400
		};

		$("#estabelecimento-ajax").easyAutocomplete(pesquisaEasy);
		/*$( window ).load(function() {
			$.ajax({
				// url para o arquivo json.php
				url: "<?php echo site_url(); ?>" + "/api/estabelecimento/busca",
				// dataType json
				type:'POST',
				dataType: "json",
				success: function ( data) {
					alert(data);
				},
				error: function ( data ) {
					console.log(data);
				}

			});//termina o ajax
		});*/

		$('#example').barrating({
			theme: 'fontawesome-stars'
		});
	</script>
</body>
</html>