<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Event.php");
require_once ("../App_Code/EventModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlEvent = $clsEvent->GetById($_GET['Id']);
}else{
	header('Location: ViewEvent.php');
	die();
}

if(isset($_POST['Election_Id'])){

  $_POST['StartDateTime'] = $_POST['StartDate'] .' '. $_POST['StartTime'];
  $_POST['EndDateTime'] = $_POST['EndDate'] .' '. $_POST['EndTime'];

	$err .= $clsFn->setForm('Type',$mdlEvent,true);
	$err .= $clsFn->setForm('StartDateTime',$mdlEvent,true);
	$err .= $clsFn->setForm('EndDateTime',$mdlEvent,true);
  $err .= $clsFn->setForm('Election_Id',$mdlEvent,true);


	if($err == ""){
		$duplicate = $clsEvent->IsExist($mdlEvent);
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
			$clsEvent->Update($mdlEvent);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Successfully Updated Event. </h4>
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0, event-scalable=0, minimal-ui">
		<meta name="description" content="<?php echo $clsContent->GetName(); ?> - Admin">
		<meta name="author" content="">

		<title>Edit Event | <?php echo $clsContent->GetName(); ?> - Admin</title>

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
      <link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.css">


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
				<h1 class="page-title">Edit New Event</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="ViewEvent.php">Event</a></li>
					<li class="breadcrumb-item active">Edit New Event</li>
				</ol>
			</div>
			<div class="page-content">
				<form method="post" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="row">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Event Details</h3>
								</div>
								<?php echo $msg; ?>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-control-label" for="inputType">Event Type</label>
                      <div class="radio">
                        <label><input type="radio" value="0" class="optradio" id="inputType0_Id" name="Type" <?php echo ($mdlEvent->getType() == "0")?'checked':''; ?>> Manual</label>
                      </div>
                      <div class="radio">
												<label><input type="radio" value="1" class="optradio" id="inputType1_Id" name="Type" <?php echo ($mdlEvent->getType() == "1")?'checked':''; ?>> Automatic</label>
                      </div>
											<small id="notif-inputName" class="invalid-feedback">This is required</small>
										</div>
									</div>


                  <?php
                    $startDate = "";
                    $startTime = "";
                    $endtDate = "";
                    $endTime = "";

                    if ($mdlEvent->getStartDateTime() != "") {
                      $startDate = date_format(date_create($mdlEvent->getStartDateTime()),"m/d/Y");
	                    $startTime = date_format(date_create($mdlEvent->getStartDateTime()),"h:ia");
                    }
                    if ($mdlEvent->getEndDateTime() != "") {
                      $endDate = date_format(date_create($mdlEvent->getEndDateTime()),"m/d/Y");
	                    $endTime = date_format(date_create($mdlEvent->getEndDateTime()),"h:ia");
                    }
                    ?>
                  <div class="row" id="datepair-wrap">
                    <div class="form-group col-md-12">
                      <label class="form-control-label" for="inputStartDateTime">Start of Event</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="date start form-control" id="inputStartDate_Id" name="StartDate" placeholder="mm/dd/yyyy" value="<?php echo $startDate; ?>" />
                        <span class="input-group-addon">
                          <i class="icon md-time" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="time start form-control" id="inputStartTime_Id" name="StartTime" placeholder="hh:mm am/pm" value="<?php echo $startTime; ?>" />
                      </div>
                      <small id="notif-inputName" class="invalid-feedback">This is required</small>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-control-label" for="inputEndDateTime">End of Event</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="date end form-control" id="inputEndDate_Id" name="EndDate" placeholder="mm/dd/yyyy" value="<?php echo $endDate; ?>" />
                        <span class="input-group-addon">
                          <i class="icon md-time" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="time end form-control" id="inputEndTime_Id" name="EndTime" placeholder="hh:mm am/pm" value="<?php echo $endTime; ?>" />
                      </div>
                      <small id="notif-inputName" class="invalid-feedback">This is required</small>
                    </div>
                  </div>

              <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="inputElection">Election</label>
                    <select class="form-control" id="inputElection" name="Election_Id" data-plugin="select2" data-placeholder="Select an Election">
                      <option></option>
                      <optgroup label="Election">
                        <?php
                        $lstElection = $clsElection->Get();
                        foreach($lstElection as $mdlElection){
                          if($mdlElection->getId() == $mdlEvent->getElection_Id()){
                            echo '<option value="'.$mdlElection->getId().'" selected>'.$mdlElection->getName().'</option>';
                          }else{
                            echo '<option value="'.$mdlElection->getId().'">'.$mdlElection->getName().'</option>';
                          }
                        }
                        ?>
                      </optgroup>
                    </select>
                    <small id="notif-inputName" class="invalid-feedback">This is required</small>
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
			<script src="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
			<script src="../global/vendor/select2/select2.full.min.js"></script>
      <script src="../global/vendor/datepair/datepair.min.js"></script>
      <script src="../global/vendor/datepair/jquery.datepair.min.js"></script>
      <script src="../global/vendor/timepicker/jquery.timepicker.min.js"></script>

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
      <script src="../global/js/Plugin/jt-timepicker.js"></script>


		<script>
			$('#submit').click(function(){
				var err = 0;
				if(!checkSelect('inputUser_Id')){
					err++;
				}
				if(!checkSelect('inputPosition_Id')){
					err++;
				}
				if(!checkSelect('inputElection_Id')){
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

		<script>
				// initialize input widgets first
				$('#datepair-wrap .time').timepicker({
						'showDuration': true,
						'timeFormat': 'g:ia'
				});

				$('#datepair-wrap .date').datepicker({
						'format': 'm/d/yyyy',
						'autoclose': true
				});

				// initialize datepair
				$('#datepair-wrap').datepair();
		</script>
	</body>
</html>
