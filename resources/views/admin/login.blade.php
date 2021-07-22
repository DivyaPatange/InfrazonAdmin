<!DOCTYPE HTML>
<html>
<head>
<title>Infrazon | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> 
addEventListener("load", function() { 
    setTimeout(hideURLbar, 0); }
, false); 
function hideURLbar(){ 
    window.scrollTo(0,1); 
} 
</script>

<!-- Bootstrap Core CSS -->
<link href="{{ asset('adminAsset/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{ asset('adminAsset/css/style.css') }}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="{{ asset('adminAsset/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href="{{ asset('adminAsset/css/SidebarNav.min.css') }}" media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="{{ asset('adminAsset/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('adminAsset/js/modernizr.custom.js') }}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="{{ asset('adminAsset/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('adminAsset/js/custom.js') }}"></script>
<link href="{{ asset('adminAsset/css/custom.css') }}" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
	
		<!-- main content start-->
		<div id="page-wrapper" style="margin:0px;">
			<div class="main-page login-page ">
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="{{ route('admin.login.submit') }}" method="post">
                            @csrf
							<input type="email" class="user @error('email') is-invalid @enderror" name="email" placeholder="Enter Your Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
							<input type="password" name="password" class="lock @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<!--footer-->
		<div class="footer">
		   <p>&copy; <?php echo date("Y"); ?> Infrazon Admin. All Rights Reserved | Designed by <a href="https://iceico.in/" target="_blank">Iceico Technologies Pvt. Ltd.</a></p>		</div>
        <!--//footer-->
	</div>
	
<!-- side nav js -->
<script src="{{ asset('adminAsset/js/SidebarNav.min.js') }}" type='text/javascript'></script>
<script>
    $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->
	
<!-- Classie --><!-- for toggle left push menu script -->
<script src="{{ asset('adminAsset/js/classie.js') }}"></script>
<script>
    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
        showLeftPush = document.getElementById( 'showLeftPush' ),
        body = document.body;
        
    showLeftPush.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( body, 'cbp-spmenu-push-toright' );
        classie.toggle( menuLeft, 'cbp-spmenu-open' );
        disableOther( 'showLeftPush' );
    };
    
    function disableOther( button ) {
        if( button !== 'showLeftPush' ) {
            classie.toggle( showLeftPush, 'disabled' );
        }
    }
</script>
<!-- //Classie --><!-- //for toggle left push menu script -->
		
<!--scrolling js-->
<script src="{{ asset('adminAsset/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('adminAsset/js/scripts.js') }}"></script>
<!--//scrolling js-->

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('adminAsset/js/bootstrap.js') }}"> </script>
<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>