<?php
/*
Page is use to edit the following
Content
	Name
	Logo
	Favicon
*/
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/ContentModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$msg = "";
$err = "";

if(isset($_POST['Name'])){

	if(isset($_POST['Name']) && $_POST['Name'] != ""){
		$mdlContent->setId('1');
		$mdlContent->setName('Name');
		$mdlContent->setValue($_POST['Name']);
	}else{
		$mdlContent->setValue('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alertlink' onclick='setFocus(\"inputName\")'>Name</a> missing.";
		$err .= "</p>";
	}

	if($err == ""){
		$mdlContent->setId('1');
		$clsContent->Update($mdlContent);
		$msg .= '
		<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Successfully Updated Name, Logo and Favicon. </h4>
		</div>';
		$imgResult = $clsContent->SetImage($_FILES["img_logo"],'2');
		if($imgResult['msg'] != ''){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Image Upload Failed </h4>
			'.$imgResult['msg'].'
			</div>';
		}
		$imgResult = $clsContent->SetImage($_FILES["img_favicon"],'3');
		if($imgResult['msg'] != ''){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Image Upload Failed </h4>
			'.$imgResult['msg'].'
			</div>';
		}
		
	}else{
		$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$err.'
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
		<meta name="description" content="<?php echo $clsContent->GetName(); ?> - Admin">
		<meta name="author" content="">
		
		<title>Edit Name, Logo and Favicon | <?php echo $clsContent->GetName(); ?> - Admin</title>
		
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
			<link rel="stylesheet" href="../global/vendor/dropify/dropify.css">
		
		
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
							
				<form method="post" action="" enctype="multipart/form-data" autocomplete="off" id="exampleConstraintsForm">
					<div class="row">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Edit Name, Logo and Favicon</h3>
								</div>
								<?php echo $msg; ?>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-12">
											<label class="form-control-label" for="in_Name">Name</label>
											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Website Name" value="<?php echo $clsContent->GetValueByName('Name'); ?>" onblur="checkInput('inputName')">
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-12">
											<label class="form-control-label" for="in_Logo">Logo</label>
											<?php
											$imgLogo = $clsImage->ToLocation($clsImage->GetById($clsContent->GetValueByName('Logo')));
											if($imgLogo != ""){
												$imgLogo = "../" . $imgLogo;
											}
											?>
											<input type="file" id="in_Logo" data-plugin="dropify" data-default-file="<?php echo $imgLogo;?>" accept="image/*" name="img_logo"/>
											<p class="text-help">(Preferred Ratio for Image: 1x1)</p>
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-12">
											<label class="form-control-label" for="in_Favicon">Favicon</label>
											<?php
											$imgFav = $clsImage->ToLocation($clsImage->GetById($clsContent->GetValueByName('Favicon')));
											if($imgFav != ""){
												$imgFav = "../" . $imgFav;
											}
											?>
											<input type="file" id="in_Favicon" data-plugin="dropify" data-default-file="<?php echo $imgFav;?>" accept="image/*" name="img_favicon"/>
											<p class="text-help">(Preferred Ratio for Image: 1x1)</p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 offset-sm-4">
											<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
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
			<script src="../global/vendor/dropify/dropify.min.js"></script>
		
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
			<script src="../global/js/Plugin/dropify.js"></script>
			
		
		<script>
			$('#submit').click(function(){
				var err = 0;
				if(!checkInput('inputName')){
					err++;
				}
				if(err!=0){
					return false;
				}
			});
			function checkInput(inputName){
				var textbox = document.getElementById(inputName);
				if($('#'+inputName).val().trim() == ''){
					textbox.classList.add("is-invalid");
					setFocus(inputName);
					return false;
				}else{
					textbox.classList.remove("is-invalid");
				}
				return true;
			}
			function setFocus(inputName) {
				var textbox = document.getElementById(inputName);
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
