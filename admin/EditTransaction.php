<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Transaction.php");
require_once ("../App_Code/TransactionModel.php");
require_once ("../App_Code/Billing.php");
require_once ("../App_Code/BillingModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlTransaction = $clsTransaction->GetById($_GET['Id']);
}else{
	header('Location: ViewTransaction.php');
	die();
}

if(isset($_POST['User_Id'])){

	$err .= $clsFn->setForm('Billing_Id',$mdlTransaction,true);
	$err .= $clsFn->setForm('User_Id',$mdlTransaction,true);
	$err .= $clsFn->setForm('DatePaid',$mdlTransaction,true);

	if($err == ""){
		if($clsTransaction->IsExist($mdlTransaction)){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			<p>This is already billed to the user.</p>
			</div>';
		}else{
			$transactionId = $clsTransaction->Update($mdlTransaction);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Successfully Updated Transaction. </h4>
			</div>';
			// Clear all data if success
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

		<title>Edit Transaction | <?php echo $clsContent->GetName(); ?> - Admin</title>

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
			<div class="page-header">
				<h1 class="page-title">Edit Transaction</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="ViewTransaction.php">Transaction</a></li>
					<li class="breadcrumb-item active">Edit Transaction</li>
				</ol>
			</div>
			<div class="page-content">
				<form method="post" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="row">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Transaction Details</h3>
								</div>
								<?php echo $msg; ?>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputBilling_Id">Bill</label>
											<select class="form-control" id="inputBilling_Id" name="Billing_Id" data-plugin="select2" data-placeholder="Select what to Bill">
												<option></option>
												<optgroup label="Bills">
													<?php
													$lstB = $clsBilling->Get();
													foreach($lstB as $mdlB){
														if($mdlB->getId() == $mdlTransaction->getBilling_Id()){
															echo '<option value="'.$mdlB->getId().'" selected>'.$mdlB->getName().'</option>';
														}else{
															echo '<option value="'.$mdlB->getId().'">'.$mdlB->getName().'</option>';
														}
													}
													?>
												</optgroup>
											</select>
											<small id="notif-inputBilling_Id" class="invalid-feedback">This is required</small>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputUser_Id">Transaction Name</label>
											<select class="form-control" id="inputUser_Id" name="User_Id" data-plugin="select2" data-placeholder="Select Name">
												<option></option>
												<optgroup label="User">
													<?php
													$lstU = $clsUser->Get();
													foreach($lstU as $mdlU){
														if($mdlU->getId() == $mdlTransaction->getUser_Id()){
															echo '<option value="'.$mdlU->getId().'" selected>'.$mdlU->getFirstName()." ".$mdlU->getMiddleName()." ".$mdlU->getLastName()." ".$mdlU->getSuffixName().'</option>';
														}else{
															echo '<option value="'.$mdlU->getId().'">'.$mdlU->getFirstName()." ".$mdlU->getMiddleName()." ".$mdlU->getLastName()." ".$mdlU->getSuffixName().'</option>';
														}
													}
													?>
												</optgroup>
											</select>
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputDatePaid">Date Paid</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="icon fa-calendar" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" data-plugin="datepicker" id="inputDatePaid" name="DatePaid" placeholder="mm/dd/yyyy" value="<?php echo $mdlTransaction->getDatePaid(); ?>">
												<small id="notif-inputDatePaid" class="invalid-feedback">This is required</small>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 offset-sm-4">
									<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
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
			<script src="../global/js/Plugin/select2.js"></script>


		<script>
			$('#submit').click(function(){
				var err = 0;
				if(!checkSelect('inputDatePaid')){
					err++;
				}
				if(!checkSelect('inputUser_Id')){
					err++;
				}
				if(!checkSelect('inputBilling_Id')){
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
			function checkSelect(inputName){
				var textbox = document.getElementById(inputName);
				var select = document.querySelector('[aria-labelledby="select2-'+inputName+'-container"]');
				if($('#'+inputName).val().trim() == ''){
					select.style.border = "1px solid #f44336";
					textbox.classList.add("is-invalid");
					setFocus(inputName);
					return false;
				}else{
					select.style.border = "1px solid #e4eaec";
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
