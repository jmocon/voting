<?php
require_once ("App_Code/Database.php");
require_once ("App_Code/Content.php");
require_once ("App_Code/Image.php");
require_once ("App_Code/ImageModel.php");
require_once ("App_Code/User.php");
require_once ("App_Code/UserModel.php");
require_once ("App_Code/UserType.php");
require_once ("App_Code/UserTypeModel.php");

$clsUser = new User();
$clsUser->CheckSession('login');

$msg = "";
if(isset($_POST['username'])){
	$resultUser = $clsUser->Login($_POST['username'],$_POST['password']);
	if($resultUser['User_Id'] != ''){
		$_SESSION['uid'] = $resultUser['User_Id'];
		$_SESSION['lock'] = 0;// 0 - Unlocked | 1 - Locked
		if($resultUser['UserType_Id'] == 1){
			header('Location: admin/index.php');
			exit;
		}else{
			header('Location: member/index.php');
			exit;
		}
	}else{
		$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Authentication Failed. </h4>
		</div>';
	}
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="description" content="bootstrap admin template">
		<meta name="author" content="">

		<title>Login | <?php echo $clsContent->GetName(); ?></title>

		<link rel="apple-touch-icon" href="<?php echo $clsContent->GetFavicon(); ?>">
		<link rel="shortcut icon" href="<?php echo $clsContent->GetFavicon(); ?>">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="global/css/bootstrap.min.css">
		<link rel="stylesheet" href="global/css/bootstrap-extend.min.css">
		<link rel="stylesheet" href="assets/css/site.min.css">

		<!-- Plugins -->
		<link rel="stylesheet" href="global/vendor/animsition/animsition.css">
		<link rel="stylesheet" href="global/vendor/asscrollable/asScrollable.css">
		<link rel="stylesheet" href="global/vendor/switchery/switchery.css">
		<link rel="stylesheet" href="global/vendor/intro-js/introjs.css">
		<link rel="stylesheet" href="global/vendor/slidepanel/slidePanel.css">
		<link rel="stylesheet" href="global/vendor/flag-icon-css/flag-icon.css">
			<link rel="stylesheet" href="assets/examples/css/pages/login.css">


		<!-- Fonts -->
		<link rel="stylesheet" href="global/fonts/web-icons/web-icons.min.css">
		<link rel="stylesheet" href="global/fonts/brand-icons/brand-icons.min.css">
		<link rel='stylesheet' href='global/fonts/Roboto/Roboto-300-400-500-300italic.css'>

		<!--[if lt IE 9]>
		<script src="global/vendor/html5shiv/html5shiv.min.js"></script>
		<![endif]-->

		<!--[if lt IE 10]>
		<script src="global/vendor/media-match/media.match.min.js"></script>
		<script src="global/vendor/respond/respond.min.js"></script>
		<![endif]-->

		<!-- Scripts -->
		<script src="global/vendor/breakpoints/breakpoints.js"></script>
		<script>
			Breakpoints();
		</script>
	</head>
	<body class="animsition page-login layout-full page-dark">
		<!--[if lt IE 8]>
				<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->


		<!-- Page -->
		<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
			<div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
				<div class="brand">
					<img class="brand-img" src="<?php echo $clsContent->GetLogo(); ?>" alt="...">
					<h2 class="brand-text"><?php echo $clsContent->GetName(); ?></h2>
				</div>
				<p>Sign into your pages account</p>
				<?php echo $msg; ?>
				<form method="post" action="login.php">
					<div class="form-group">
						<label class="sr-only" for="inputUsername">Username</label>
						<input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<label class="sr-only" for="inputPassword">Password</label>
						<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary btn-block">Sign in</button>
				</form>
				<p>Not registered yet? <a href="register.php">Create</a> an account.</p>

				<footer class="page-copyright page-copyright-inverse">
					<p>© 2018. All RIGHT RESERVED.</p>
					<div class="social">
						<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-twitter" aria-hidden="true"></i>
				</a>
						<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-facebook" aria-hidden="true"></i>
				</a>
						<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-dribbble" aria-hidden="true"></i>
				</a>
					</div>
				</footer>
			</div>
		</div>
		<!-- End Page -->


		<!-- Core	-->
		<script src="global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
		<script src="global/vendor/jquery/jquery.js"></script>
		<script src="global/vendor/popper-js/umd/popper.min.js"></script>
		<script src="global/vendor/bootstrap/bootstrap.js"></script>
		<script src="global/vendor/animsition/animsition.js"></script>
		<script src="global/vendor/mousewheel/jquery.mousewheel.js"></script>
		<script src="global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
		<script src="global/vendor/asscrollable/jquery-asScrollable.js"></script>

		<!-- Plugins -->
		<script src="global/vendor/switchery/switchery.js"></script>
		<script src="global/vendor/intro-js/intro.js"></script>
		<script src="global/vendor/screenfull/screenfull.js"></script>
		<script src="global/vendor/slidepanel/jquery-slidePanel.js"></script>
				<script src="global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Scripts -->
		<script src="global/js/Component.js"></script>
		<script src="global/js/Plugin.js"></script>
		<script src="global/js/Base.js"></script>
		<script src="global/js/Config.js"></script>

		<script src="assets/js/Section/Menubar.js"></script>
		<script src="assets/js/Section/Sidebar.js"></script>
		<script src="assets/js/Section/PageAside.js"></script>
		<script src="assets/js/Plugin/menu.js"></script>

		<!-- Config -->
		<script src="global/js/config/colors.js"></script>
		<script src="assets/js/config/tour.js"></script>
		<script>Config.set('assets', 'assets');</script>

		<!-- Page -->
		<script src="assets/js/Site.js"></script>
		<script src="global/js/Plugin/asscrollable.js"></script>
		<script src="global/js/Plugin/slidepanel.js"></script>
		<script src="global/js/Plugin/switchery.js"></script>
				<script src="assets/js/Plugin/jquery-placeholder.js"></script>

		<script>
			(function(document, window, $){
				'use strict';

				var Site = window.Site;
				$(document).ready(function(){
					Site.run();
				});
			})(document, window, jQuery);
		</script>

	</body>
</html>
