<!DOCTYPE HTML>
<html>
<head>
<title>Infrazon | Admin | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('admin.admin_layout.stylesheet')
@yield('customcss')
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>

</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		@include('admin.admin_layout.sidebar')
	</div>
	<!--left-fixed -navigation-->

    <!-- header-starts -->
    @include('admin.admin_layout.topbar')
    <!-- //header-ends -->
    <!-- main content start-->
    @yield('content')
    
	<!--footer-->
	<div class="footer">
	   <p>&copy; <?php echo date('Y'); ?> Infrazon Admin Dashboard. All Rights Reserved | Design by <a href="https://iceico.in/" target="_blank">Iceico  Technologies Pvt. Ltd.</a></p>		
	</div>
    <!--//footer-->
</div>
<!-- new added graphs chart js-->
@include('admin.admin_layout.scripts')  
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('customjs')
</body>
</html>