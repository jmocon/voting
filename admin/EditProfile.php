<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/UserType.php");
require_once ("../App_Code/UserTypeModel.php");

$msg = "";
$err = "";

if(isset($_SESSION['uid']) && $_SESSION['uid'] != ""){
	$mdlUser = $clsUser->GetById($_SESSION['uid']);
}else{
	header('Location: index.php');
	die();
}

if(isset($_POST['FirstName'])){

	if(isset($_POST['FirstName']) && $_POST['FirstName'] != ""){
		$mdlUser->setFirstName($_POST['FirstName']);
	}else{
		$mdlUser->setFirstName('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputFirstName\")'>FirstName</a> missing.";
		$err .= "</p>";
	}


	if(isset($_POST['MiddleName']) && $_POST['MiddleName'] != ""){
		$mdlUser->setMiddleName($_POST['MiddleName']);
	}else{
		$mdlUser->setMiddleName('');
	}


	if(isset($_POST['LastName']) && $_POST['LastName'] != ""){
		$mdlUser->setLastName($_POST['LastName']);
	}else{
		$mdlUser->setLastName('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputLastName\")'>LastName</a> missing.";
		$err .= "</p>";
	}


	if(isset($_POST['SuffixName']) && $_POST['SuffixName'] != ""){
		$mdlUser->setSuffixName($_POST['SuffixName']);
	}else{
		$mdlUser->setSuffixName('');
	}


	if(isset($_POST['BirthDate']) && $_POST['BirthDate'] != ""){
		$mdlUser->setBirthDate($_POST['BirthDate']);
	}else{
		$mdlUser->setBirthDate('');
	}


	if(isset($_POST['Gender_Id']) && $_POST['Gender_Id'] != ""){
		$mdlUser->setGender_Id($_POST['Gender_Id']);
	}else{
		$mdlUser->setGender_Id('');
	}


	if(isset($_POST['MobileNumber']) && $_POST['MobileNumber'] != ""){
		$mdlUser->setMobileNumber($_POST['MobileNumber']);
	}else{
		$mdlUser->setMobileNumber('');
	}


	if(isset($_POST['TelephoneNumber']) && $_POST['TelephoneNumber'] != ""){
		$mdlUser->setTelephoneNumber($_POST['TelephoneNumber']);
	}else{
		$mdlUser->setTelephoneNumber('');
	}


	if(isset($_POST['HomeAddress']) && $_POST['HomeAddress'] != ""){
		$mdlUser->setHomeAddress($_POST['HomeAddress']);
	}else{
		$mdlUser->setHomeAddress('');
	}


	if(isset($_POST['EmailAddress']) && $_POST['EmailAddress'] != ""){
		$mdlUser->setEmailAddress($_POST['EmailAddress']);
	}else{
		$mdlUser->setEmailAddress('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputEmailAddress\")'>EmailAddress</a> missing.";
		$err .= "</p>";
	}


	if(isset($_POST['Facebook']) && $_POST['Facebook'] != ""){
		$mdlUser->setFacebook($_POST['Facebook']);
	}else{
		$mdlUser->setFacebook('');
	}


	if(isset($_POST['Twitter']) && $_POST['Twitter'] != ""){
		$mdlUser->setTwitter($_POST['Twitter']);
	}else{
		$mdlUser->setTwitter('');
	}


	if(isset($_POST['GooglePlus']) && $_POST['GooglePlus'] != ""){
		$mdlUser->setGooglePlus($_POST['GooglePlus']);
	}else{
		$mdlUser->setGooglePlus('');
	}


	if(isset($_POST['LinkedIn']) && $_POST['LinkedIn'] != ""){
		$mdlUser->setLinkedIn($_POST['LinkedIn']);
	}else{
		$mdlUser->setLinkedIn('');
	}


	if(isset($_POST['Username']) && $_POST['Username'] != ""){
		$mdlUser->setUsername($_POST['Username']);
	}else{
		$mdlUser->setUsername('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputUsername\")'>Username</a> missing.";
		$err .= "</p>";
	}


	if(isset($_POST['Password']) && $_POST['Password'] != ""){
		$mdlUser->setPassword($_POST['Password']);
	}else{
		$mdlUser->setPassword('');
		$err .= "<p>";
		$err .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputPassword\")'>Password</a> missing.";
		$err .= "</p>";
	}

	if($err == ""){
		$duplicate = $clsUser->IsExist($mdlUser);
		if($duplicate['val']){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$clsUser->Update($mdlUser);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Successfully Updated User. </h4>
			</div>';
			$imgResult = $clsUser->SetImage($_FILES["fileToUpload"],$mdlUser->getId());
			if(!$imgResult['val']){
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
		<meta name="description" content="<?php echo $clsContent->GetName(); ?> - Member's Page">
		<meta name="author" content="">
		
		<title>Edit Profile | <?php echo $clsContent->GetName(); ?> - Member</title>
		
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
								<?php echo $msg; ?>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-12">
											<label class="form-control-label" for="inputFirstName">Full Name</label>
											<div class="row">
												<div class="col-4">
													<input type="text" class="form-control" id="inputFirstName" name="FirstName" placeholder="First Name" value="<?php echo $mdlUser->getFirstName(); ?>">
													<small id="notif-inputName" class="invalid-feedback">This is required</small>
												</div>
												<div class="col-3">
													<input type="text" class="form-control" id="inputMiddleName" name="MiddleName" placeholder="Middle Name" value="<?php echo $mdlUser->getMiddleName(); ?>">
												</div>
												<div class="col-3">
													<input type="text" class="form-control" id="inputLastName" name="LastName" placeholder="Last Name" value="<?php echo $mdlUser->getLastName(); ?>">
													<small id="notif-inputName" class="invalid-feedback">This is required</small>
												</div>
												<div class="col-2">
													<input type="text" class="form-control" id="inputSuffixName" name="SuffixName" placeholder="Suffix Name" value="<?php echo $mdlUser->getSuffixName(); ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputBirthDate">Date of Birth</label>
											<div class="row">
												<div class="col-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="icon fa-calendar" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" data-plugin="datepicker" id="inputBirthDate" name="BirthDate" placeholder="mm/dd/yyyy" value="<?php echo $mdlUser->getBirthDate(); ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputMale" id="inputGender_Id">Gender</label>
											<div class="row">
												<div class="radio-custom radio-default radio-inline">
													<input type="radio" id="inputMale" name="Gender_Id" value="1" <?php echo ($mdlUser->getGender_Id() == "1")?'checked="checked"':'';?>>
													<label for="inputBasicMale">Male</label>
												</div>
												<div class="radio-custom radio-default radio-inline">
													<input type="radio" id="inputFemale" name="Gender_Id" value="2" <?php echo ($mdlUser->getGender_Id() == "2")?'checked="checked"':'';?>>
													<label for="inputBasicFemale">Female</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel-heading">
									<h3 class="panel-title">Contact Details</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputMobileNumber">Mobile Number</label>
											<input type="text" class="form-control" id="inputMobileNumber" name="MobileNumber" placeholder="(country code) mobile number" value="<?php echo $mdlUser->getMobileNumber(); ?>">
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputEmailAddress">Email Address</label>
											<input type="email" class="form-control" id="inputEmailAddress" name="EmailAddress" placeholder="juandelacruz@email.com" value="<?php echo $mdlUser->getEmailAddress(); ?>" >
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputTelephoneNumber">Telephone Number</label>
											<input type="text" class="form-control" id="inputTelephoneNumber" name="TelephoneNumber" placeholder="(area code) phone number (Optional)" value="<?php echo $mdlUser->getTelephoneNumber(); ?>">
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputHomeAddress">Home Address</label>
											<input type="text" class="form-control" id="inputHomeAddress" name="HomeAddress" placeholder="Bldg No./Street/District/City (Optional)" value="<?php echo $mdlUser->getHomeAddress(); ?>">
										</div>
									</div>
								</div>
								
								<div class="panel-heading">
									<h3 class="panel-title">Social Networks</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputFacebook">Facebook</label>
											<input type="text" class="form-control" id="inputFacebook" name="Facebook" placeholder="https://www.facebook.com/juan.dela.cruz (Optional)" value="<?php echo $mdlUser->getFacebook(); ?>">
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputTwitter">Twitter</label>
											<input type="text" class="form-control" id="inputTwitter" name="Twitter" placeholder="@juandelacruz (Optional)" value="<?php echo $mdlUser->getTwitter(); ?>">
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputGooglePlus">GooglePlus</label>
											<input type="text" class="form-control" id="inputGooglePlus" name="GooglePlus" placeholder="GooglePlus Url (Optional)" value="<?php echo $mdlUser->getGooglePlus(); ?>">
										</div>
										<div class="form-group col-xxl-3 col-md-6">
											<label class="form-control-label" for="inputLinkedIn">LinkedIn</label>
											<input type="text" class="form-control" id="inputLinkedIn" name="LinkedIn" placeholder="LinkedIn Url (Optional)" value="<?php echo $mdlUser->getLinkedIn(); ?>">
										</div>
									</div>
								</div>
								
								<div class="panel-heading">
									<h3 class="panel-title">Account Details</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputUsername">Username</label>
											<input type="text" class="form-control" id="inputUsername" name="Username" placeholder="Username" value="<?php echo $mdlUser->getUsername(); ?>" >
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputPassword">Password</label>
											<input type="password" class="form-control" id="inputPassword" name="Password" placeholder="Password" value="<?php echo $mdlUser->getPassword(); ?>" >
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-12">
											<label class="form-control-label" for="inputImage">Profile Picture</label>
											<?php
											$userImage = "";
											$lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"original");
											foreach($lstImage as $mdlImg){
												$mdlImage = $mdlImg;
											}
											$userImage = "../" . $clsImage->ToLocation($mdlImage);
											?>
											<input type="file" id="inputImage" data-plugin="dropify" data-default-file="<?php echo $userImage;?>" accept="image/*" name="fileToUpload"/>
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
			<script src="../assets/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
			<script src="../global/vendor/dropify/dropify.min.js"></script>
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
			
		
		<script>

			$('#submit').click(function(){
				var err = 0;
				if(!checkInput('inputPassword')){
					err++;
				}
				if(!checkInput('inputUsername')){
					err++;
				}
				if(!checkInput('inputEmailAddress')){
					err++;
				}
				if(!checkInput('inputLastName')){
					err++;
				}
				if(!checkInput('inputFirstName')){
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
