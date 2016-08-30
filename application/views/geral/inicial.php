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
			<div class="container"></div>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<!-- owl carousel -->
			<div class="col-lg-12 menu-recomendacoes">
				<span class="label label-primary">Recomendação 01</span>
				<span class="label label-primary">Recomendação 02</span>
				<span class="label label-primary">Recomendação 03</span>
				<span class="label label-primary">Recomendação 04</span>
				<span class="label label-primary">Recomendação 05</span>
				<span class="label label-primary">Recomendação 06</span>
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
	</script>
</body>
</html>