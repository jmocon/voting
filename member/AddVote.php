<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Candidate.php");
require_once ("../App_Code/CandidateModel.php");
require_once ("../App_Code/CandidatePosition.php");
require_once ("../App_Code/CandidatePositionModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");
require_once ("../App_Code/Vote.php");
require_once ("../App_Code/VoteModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/UserType.php");
require_once ("../App_Code/UserTypeModel.php");

$clsUser->CheckSession('member');
$msg = "";
$err = "";
$electionId ="";
$lstCP = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$electionId = $_GET['Id'];
  $lstCP = $clsCandidatePosition->GetByElectionId($electionId);
}else{
	header('Location: index.php');
  die();
}

if(isset($_POST['Vote'])){
	foreach ($lstCP as $mdlCP) {
		foreach ($_POST['CP'.$mdlCP->getId()] as $key => $value) {
			$mdlVote = new VoteModel();
			$_POST['User_Id'] = $_SESSION['uid'];
			$_POST['Election_Id'] = $electionId;
			$_POST['Candidate_Id'] = $value;
			$err .= $clsFn->setForm('User_Id',$mdlVote,true);
			$err .= $clsFn->setForm('Election_Id',$mdlVote,true);
			$err .= $clsFn->setForm('Candidate_Id',$mdlVote,true);
			if($err == ""){
					$clsVote->Add($mdlVote);
					$msg = '
					<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
					</button>
					<h4>Successfully Submitted Vote. </h4>
					</div>';

			}else{
				$msg .= '
				<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h4>Error Encountered. Please refresh the page or notify the host. </h4>
				'.$err.'
				</div>';
			}
		}
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
		<link rel="stylesheet" href="assets/css/site.css">

		<!-- Plugins -->
		<link rel="stylesheet" href="../global/vendor/animsition/animsition.css">
		<link rel="stylesheet" href="../global/vendor/asscrollable/asScrollable.css">
		<link rel="stylesheet" href="../global/vendor/switchery/switchery.css">
		<link rel="stylesheet" href="../global/vendor/intro-js/introjs.css">
		<link rel="stylesheet" href="../global/vendor/slidepanel/slidePanel.css">
		<link rel="stylesheet" href="../global/vendor/flag-icon-css/flag-icon.css">
		<link rel="stylesheet" href="../global/vendor/waves/waves.css">
      <link rel="stylesheet" href="../global/vendor/jquery-labelauty/jquery-labelauty.css">


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

		<!-- Page -->
		<div class="page">
			<div class="page-content">

				<form method="post" action="" enctype="multipart/form-data" autocomplete="off">
					<div class="row">
						<div class="col-12">
							<div class="panel">

								<div class="panel-heading">
									<h3 class="panel-title"><?php echo $clsElection->GetNameById($electionId); ?></h3>
								</div>

								<?php echo $msg; ?>

                <?php foreach ($lstCP as $mdlCP) { ?>
  								<div class="panel-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputCandidatePositionName"><?php echo $mdlCP->getName(); ?> <small>(Select maximum of <?php echo $mdlCP->getMaxVote(); ?> candidate)</small></label>
  											<div class="row ">
                          <div class="col-lg-4 cp<?php echo $mdlCP->getId(); ?>">
                            <?php
                            $lstC = $clsCandidate->GetByCandidatePosition_Id($mdlCP->getId());
                            foreach ($lstC as $mdlC) { ?>
                              <input type="checkbox" class="to-labelauty" name="CP<?php echo $mdlCP->getId(); ?>[]" data-plugin="labelauty" data-labelauty="<?php echo $clsUser->GetNameById($mdlC->getUser_Id()); ?>" value="<?php echo $mdlC->getId(); ?>" />
                            <?php
                            }
                            ?>
                          </div>
  											</div>
  										</div>
  									</div>
                  </div>
                <?php } ?>
  							<div class="panel-body">
                  <div class="row">
                    <div class="col-12">
                      <input type="submit" name="Vote" class="form-control" />
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
      <script src="../global/vendor/jquery-labelauty/jquery-labelauty.js"></script>

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
      <script src="../global/js/Plugin/jquery-labelauty.js"></script>


		<script>
  		<?php
			foreach ($lstCP as $mdlCP) { ?>
	      $('.cp<?php echo $mdlCP->getId(); ?> :checkbox').change(function () {
	          var $cs = $(this).closest('.cp<?php echo $mdlCP->getId(); ?>').find(':checkbox:checked');
	          if ($cs.length > <?php echo $mdlCP->getMaxVote(); ?>) {
	              this.checked = false;
	          }
	      });
			<?php
			} ?>
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
