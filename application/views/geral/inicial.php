<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/third_party/favicon/apple-touch-icon.png')?>">
	<link rel="icon" type="image/png" href="<?=base_url('assets/third_party/favicon/favicon-32x32.png')?>" sizes="32x32">
	<link rel="icon" type="image/png" href="<?=base_url('assets/third_party/favicon/favicon-16x16.png')?>" sizes="16x16">
	<link rel="manifest" href="<?=base_url('assets/third_party/favicon/manifest.json')?>">
	<link rel="mask-icon" href="<?=base_url('assets/third_party/favicon/safari-pinned-tab.svg')?>" color="#5bbad5">
	<meta name="theme-color" content="#27568d">

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css')?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url('assets/fonts/font-awesome.min.css')?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url('assets/fonts//ionicons.min.css')?>">
	<!-- Estilo -->
	<link rel="stylesheet" href="<?=base_url('assets/css/estilo_geral.css')?>">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<div class="row">
		<div class="banner-inicio">
			<img src="<?=base_url('assets/third_party/logo/logo-branco.png')?>">
		</div>
		<div class="sub-menu">

		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-xs-12 menu-lateral">

		</div>
		<div class="col-lg-9 col-md-8 col-xs-12 mapa" >
			<div id="map"></div>

		</div>
	</div>
	<!-- jQuery 2.2.3 -->
	<script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
	<!-- MAPS -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_cPiH8zBAbz360dlO4I1wrrqVgKvN4z4&callback=initMap"
			async defer></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?=base_url('assets/js/bootstrap.js')?>"></script>

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