<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Gender.php");
require_once ("../App_Code/GenderModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/UserType.php");
require_once ("../App_Code/UserTypeModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$msg = "";
$err = "";
$mdlUser = new UserModel();
if(isset($_SESSION['uid']) && $_SESSION['uid'] != ""){
	$mdlUser = $clsUser->GetById($_SESSION['uid']);
}else{
	header('Location: index.php');
	die();
}

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="description" content="<?php echo $clsContent->GetName(); ?> - Admin">
		<meta name="author" content="">
		
		<title>Profile | <?php echo $clsContent->GetName(); ?> - Admin</title>
		
		<link rel="apple-touch-icon" href="../<?php echo $clsContent->GetFavicon(); ?>">
		<link rel="shortcut icon" href="../<?php echo $clsContent->GetFavicon(); ?>">
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="../global/css/bootstrap.min.css">
		<link rel="stylesheet" href="../global/css/bootstrap-extend.min.css">
		<link rel="stylesheet" href="assets/css/site.min.css">
		
		<!-- Plugins -->
		<link rel="stylesheet" href="../global/vendor/animsition/animsition.css">
		<link rel="stylesheet" href="../global/vendor/asscrollable/asScrollable.css">
		<link rel="stylesheet" href="../global/vendor/switchery/switchery.css">
		<link rel="stylesheet" href="../global/vendor/intro-js/introjs.css">
		<link rel="stylesheet" href="../global/vendor/slidepanel/slidePanel.css">
		<link rel="stylesheet" href="../global/vendor/flag-icon-css/flag-icon.css">
		<link rel="stylesheet" href="../global/vendor/waves/waves.css">
			<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
			<link rel="stylesheet" href="../global/vendor/dropify/dropify.css">
			<link rel="stylesheet" href="../global/vendor/formvalidation/formValidation.css">
			<link rel="stylesheet" href="../global/vendor/select2/select2.css">
		
		
		<!-- Fonts -->
		<link rel="stylesheet" href="../global/fonts/material-design/material-design.min.css">
		<link rel="stylesheet" href="../global/fonts/brand-icons/brand-icons.min.css">
		<link rel="stylesheet" href="../global/fonts/font-awesome/font-awesome.min.css">
		<link rel='stylesheet' href='../global/fonts/Roboto/Roboto-300-400-500-300italic.css'>
		
		<!--[if lt IE 9]>
		<script src="../global/vendor/html5shiv/html5shiv.min.js"></script>
		<![endif]-->
		
		<!--[if lt IE 10]>
		<script src="../global/vendor/media-match/media.match.min.js"></script>
		<script src="../global/vendor/respond/respond.min.js"></script>
		<![endif]-->
		
		<!-- Scripts -->
		<script src="../global/vendor/breakpoints/breakpoints.js"></script>
		<script>
			Breakpoints();
		</script>
	</head>
	<body class="animsition">
		<!--[if lt IE 8]>
				<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<?php include "nav.php"; ?>
		<?php include "menubar.php"; ?>
		<?php include "gridmenu.php"; ?>
			
		

		<!-- Page -->
		<div class="page">
			<div class="page-content">
				<form method="post" action="" enctype="multipart/form-data" id="exampleConstraintsForm">
					<div class="row">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Personal Details</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 text-center">
											<?php
											$userImage = "";
											$lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"150");
											foreach($lstImage as $mdlImage){
												$userImage = "../" . $clsImage->ToLocation($mdlImage);
											}
											?>
											<img src="<?php echo $userImage; ?>" class="img-fluid h-150 img-bordered" />
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-12">
											<h4>Personal Details</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Full Name
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getFirstName()." (".$mdlUser->getMiddleName().") ".$mdlUser->getLastName()." ".$mdlUser->getSuffixName(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Date of Birth
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getBirthDate(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Gender
										</div>
										<div class="col-md-8">
											<?php echo $clsGender->GetNameById($mdlUser->getGender_Id()); ?>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-12">
											<h4>Contact Details</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Email Address
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getEmailAddress(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Mobile Number
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getMobileNumber(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Telephone Number
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getTelephoneNumber(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Home Address
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getHomeAddress(); ?>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-12">
											<h4>Social Networks</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Facebook
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getFacebook(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Twitter
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getTwitter(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											GooglePlus
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getGooglePlus(); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											LinkedIn
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getLinkedIn(); ?>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-12">
											<h4>Account Details</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											User Type
										</div>
										<div class="col-md-8">
											<?php echo $clsUserType->GetNameById($mdlUser->getUserType_Id()); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Username
										</div>
										<div class="col-md-8">
											<?php echo $mdlUser->getUsername(); ?>
										</div>
									</div>
									<div class="row m-2 p-2">
										<div class="col-sm-4 offset-sm-4 text-center">
											<a href="EditProfile.php" class="form-control btn-primary" style="text-decoration:none;">Edit Profile</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End Page -->


		<!-- Footer -->
		<?php include "footer.php"; ?>
		
		<!-- Core  -->
		<script src="../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
		<script src="../global/vendor/jquery/jquery.js"></script>
		<script src="../global/vendor/popper-js/umd/popper.min.js"></script>
		<script src="../global/vendor/bootstrap/bootstrap.js"></script>
		<script src="../global/vendor/animsition/animsition.js"></script>
		<script src="../global/vendor/mousewheel/jquery.mousewheel.js"></script>
		<script src="../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
		<script src="../global/vendor/asscrollable/jquery-asScrollable.js"></script>
		<script src="../global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
		<script src="../global/vendor/waves/waves.js"></script>
		
		<!-- Plugins -->
		<script src="../global/vendor/switchery/switchery.js"></script>
		<script src="../global/vendor/intro-js/intro.js"></script>
		<script src="../global/vendor/screenfull/screenfull.js"></script>
		<script src="../global/vendor/slidepanel/jquery-slidePanel.js"></script>
			<script src="../assets/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
			<script src="../global/vendor/dropify/dropify.min.js"></script>
			<script src="../global/vendor/formvalidation/NoDisable/formValidation.js"></script>
			<script src="../global/vendor/formvalidation/framework/bootstrap4.min.js"></script>
			<script src="../global/vendor/select2/select2.full.min.js"></script>
		
		<!-- Scripts -->
		<script src="../global/js/Component.js"></script>
		<script src="../global/js/Plugin.js"></script>
		<script src="../global/js/Base.js"></script>
		<script src="../global/js/Config.js"></script>
		
		<script src="assets/js/Section/Menubar.js"></script>
		<script src="assets/js/Section/GridMenu.js"></script>
		<script src="assets/js/Section/Sidebar.js"></script>
		<script src="assets/js/Section/PageAside.js"></script>
		<script src="assets/js/Plugin/menu.js"></script>
		
		<script src="../global/js/config/colors.js"></script>
		<script src="../assets/js/config/tour.js"></script>
		<script>Config.set('assets', 'assets');</script>
		
		<!-- Page -->
		<script src="assets/js/Site.js"></script>
		<script src="../global/js/Plugin/asscrollable.js"></script>
		<script src="../global/js/Plugin/slidepanel.js"></script>
		<script src="../global/js/Plugin/switchery.js"></script>
			<script src="../global/js/Plugin/bootstrap-datepicker.js"></script>
			<script src="../global/js/Plugin/dropify.js"></script>
			<script src="../global/js/Plugin/select2.js"></script>
			
			<script src="assets/examples/js/forms/validation.js"></script>
			
		
		<script>
			function setFocus(inputName) {
				var textbox = document.getElementById(inputName);
				textbox.focus();
				textbox.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});
			}
			
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
