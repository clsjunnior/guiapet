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
						<li><a href="#"><span class="fa fa-map-marker" style="margin-right: 5px;"></span> Mapa</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href=""><span class="fa fa-phone" style="margin-right: 5px;"></span> Contato</a></li>
						<?php if (getSesUser(['Login'])): ?>
							<li><a href="<?= site_url('dashboard') ?>"><span class="fa fa-user"
																			 style="margin-right: 5px;"></span> <?= getSesUser(['Login']) ?>
								</a></li>
							<input type="hidden" value="<?= getSesUser(['CodUsuario']) ?>" id="verificaUser"/>
						<?php else: ?>
							<li><a href="<?= site_url('dashboard') ?>"><span class="fa fa-lock"
																			 style="margin-right: 5px;"></span>
									Login</a></li>
							<input type="hidden" value="null" id="verificaUser"/>
						<?php endif; ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
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
			<h3>Você tambem pode estar interessado nos itens abaixo...</h3>
			<div class="col-lg-12 menu-recomendacoes owl-carousel owl-theme">
				<div id="recomendacao"></div>
			</div>
			<h3 style="text-align: right;">Clique e conheça esses estabelecimentos!</h3>
		</div>
	</div>
	<div class="row" style="margin-top:20px">

		<div class="col-lg-3 col-md-4 col-xs-12 menu-lateral">
            <div class="panel panel-default panel-inicial">
				<div class="panel-heading">
					<h3>Opções de Pesquisa</h3>
				</div>
				<div class="panel-body">
					<form>
						<div class="form-group">
							<label for="categoria">Estabelecimentos por categoria</label>
                            <select class="form-control" id="categoriaEs">
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
                            <div class="input-group">
								<input type="text" id="estabelecimento-busca" data-id-es="" class="form-control"
									   placeholder="Informe o nome do estabelecimento">
                                <span class="input-group-btn">
									<button id="pesquisaEs" disabled="disabled" class="btn btn-default my-btn"
                                            type="button" style="height: 34px; color:#fff;"><i
                                            class="fa fa-search fa-lg"></i> </button>
								  </span>
                            </div><!-- /input-group -->
						</div>
						<div class="form-group">
							<label for="tag">Tag - Palavras-Chave</label>
                            <div class="input-group">
                                <select class="form-control" id="tag" multiple="multiple" data-tag-id="">
                                </select>
                                <span class="input-group-btn">
									<button id="pesquisaEsTag" class="btn btn-default my-btn"
											type="button" style="height: 34px; color:#fff;"><i
                                            class="fa fa-search fa-lg"></i> </button>
								</span>
                            </div>
						</div>
						<div class="form-group">
							<label>Avaliação</label><br>
                            <select id="avaliacao">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="form-group">
							<label>Pesquisa por proximidade</label><br>
                            <a class="btn btn-primary btn-lg my-btn" id="btnLocalizacao">Ativar minha localização</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 col-xs-12" style="padding: 0px">
			<div id="mapa"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="seperator"><i class="fa fa-flag"></i></div>
			<h1 style="text-align: center; margin-bottom: 30px;">3 motivos para ter seu negócio no Guia do Pet!</h1>
			<div class="seperator"><i class="fa fa-flag"></i></div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="http://placehold.it/350x250"" alt="...">
					<div class="caption">
						<h3>Vantagem 01</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aut consequatur fugiat illum,
							incidunt laboriosam numquam porro quam quibusdam quo, quos rem, repellat reprehenderit
							soluta sunt veritatis vero! Obcaecati, totam.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="http://placehold.it/350x250"" alt="...">
					<div class="caption">
						<h3>Vantagem 01</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet atque cupiditate deserunt,
							eaque eos est ex fuga harum labore laborum molestias nisi optio, reprehenderit sapiente
							ullam veritatis vero voluptates.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="http://placehold.it/350x250"" alt="...">
					<div class="caption">
						<h3>Vantagem 03</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam beatae blanditiis,
							cumque doloribus dolorum est expedita, fuga ipsum itaque molestias non odit perferendis
							placeat provident quos saepe sint vero. </p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12">
				<button class="btn btn-primary btn-lg my-btn btn-block" style="margin-top: 20px; margin-bottom: 30px">
					Cadastre-se, é gratuito!!
				</button>
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


	<script>
		
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
        });

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});

        $("#categoriaEs, #tag").select2({
            placeholder: 'Selecione uma Opção',
            maximumInputLength: 30
		});


		$.getJSON(site_url + "/api/tags/buscaTag/", function (resultados) {
            var tags = " ";
            $.each(resultados, function (index, resp) {
                //tags += '{id: '+resp.codTag+', text: '+resp.tag+'},';
                // cria os options com os dados do json
                tags += '<option value="' + resp.codTag + '">' + resp.tag + '</option>';
            });
            // atribui no campo de tag
            $("#tag").html(tags);
        });

        $("#tag").change(function () {
            var str = [];
            $('#tag :selected').each(function (i, selecionado) {
                str.push($(selecionado).val());
            });
            $(this).attr('data-tag-id', str);
        });

		/*Easy autocomplete para busca de estabelecimentos*/
        var pesquisaEstabelecimento = {
			url: site_url + "/api/estabelecimento/buscaEsOrdenada/",

            categories: [{
                listLocation: "Clinica Veterinária",
                maxNumberOfElements: 10,
                header: "--- Clinicas Veterinárias ---"
            }, {
                listLocation: "Pet Shop",
                maxNumberOfElements: 10,
                header: "--- Pet Shops ---"
            }, {
                listLocation: "Hoteis para Pet",
                maxNumberOfElements: 10,
                header: "--- Hoteis para Pet ---"
            }, {
                listLocation: "Adestradores",
                maxNumberOfElements: 10,
                header: "--- Adestradores ---"
            }, {
                listLocation: "Taxi Pet",
                maxNumberOfElements: 10,
                header: "--- Taxi Pet ---"
            }
            ],

			getValue: function(element) {
                var id = parseFloat(element.idEs);
				$("#estabelecimento-busca").attr("data-id-es", id);
				return element.nome;
				console.log(element.nome);
			},
            list: {
                match: {
                    enabled: true
				}

            }
		};

		$("#estabelecimento-busca").easyAutocomplete(pesquisaEstabelecimento);

        /** verifica se o campo de estabelecimento esta preenchido para poder acionar o botao
         *
         * @type {*|jQuery|HTMLElement}
         */
		var input = $('#estabelecimento-busca');
        input.on('keyup', verificarInputs);

        function verificarInputs() {
            var preenchidos = true;
            input.each(function () {
                if (!this.value) {
                    preenchidos = false;
                    return false;
                }
            });
            $('#pesquisaEs').prop('disabled', !preenchidos);
        }

        $('#avaliacao').barrating({
			theme: 'fontawesome-stars'
		});

		$.getJSON(site_url + "/api/Estabelecimento/recomendacao/" + $('#verificaUser').val(), function (resultados) {
			var result = " ";

			$.each(resultados, function (index, resp) {
				var href = site_url + "/estabelecimento/" + resp.CodEstabelecimento;
				result += '<a class="label label-primary item label-recomendacao" href="' + href + '">' + resp.Nome + '</a>';
			});
			// atribui no campo de tag
			$("#recomendacao").html(result);
		});

	</script>
</body>
</html>