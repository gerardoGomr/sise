<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if !IE]><!-->
<html class=""><!-- <![endif]-->
	<head>
		<title>Centro Estatal de Control de Confianza Certificado.- SISE</title>

		<!-- Meta -->
		<meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />

		<!-- CSS DEFINITION -->
		<link rel="shortcut icon" href="{{ asset('public/img/logo.png') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/admin/admin.css') }}" />
		@yield('css')

		<script type="text/javascript">
			if (/*@cc_on!@*/false && document.documentMode === 10) {
				document.documentElement.className+=' ie ie10';
			}
		</script>

	</head>

	<body>
		<!-- Main Container Fluid -->
		<div class="container-fluid">
			@include('navbar_fusion')
			<!-- Content -->
			<div id="content">
				<div class="layout-app">
					@yield('contenido')
				</div>
			</div>

			<!-- // Content END -->
			<div class="clearfix"></div>

			<!-- Footer -->
			<div id="footer" class="hidden-print">
				<!--  Copyright Line -->
				<div class="copy">&copy; {{ date('Y') }} - <a href="#">SISE v2.0</a> - Sistema Integral de Seguimiento de Evaluaciones - Unidad de Informática</div>
				<!--  End Copyright Line -->
			</div>
			<!-- Footer END -->
		</div>

		<!-- Global -->
		<script data-id="App.Config">
			var basePath           = '',
			commonPath             = 'assets/',
			rootPath               = '',
			DEV                    = false,
			componentsPath         = 'assets/components/',
			layoutApp              = false,
			module                 = 'admin';

			var primaryColor       = '#013f78',
			dangerColor            = '#b55151',
			successColor           = '#609450',
			infoColor              = '#4a8bc2',
			warningColor           = '#ab7a4b',
			inverseColor           = '#45484d';

			var themerPrimaryColor = primaryColor;
		</script>

		<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery/jquery.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/script.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/modernizr/modernizr.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/bootstrap/js/bootstrap.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>

		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/breakpoints/breakpoints.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/davis.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/jquery.lazyjaxdavis.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/bootbox.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/less-js/less.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>

		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/preload.pace.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.main.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.collapse.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.kis.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/core.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/animations.init.js?v=v1.9.6') }}"></script>
		@yield('js')
	</body>
</html>