<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Vote.php");
require_once ("../App_Code/VoteModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Candidate.php");
require_once ("../App_Code/CandidateModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");
require_once ("../App_Code/CandidatePosition.php");
require_once ("../App_Code/CandidatePositionModel.php");
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="description" content="<?php echo $clsContent->GetName(); ?> - Admin">
		<meta name="author" content="">

		<title>Vote List | <?php echo $clsContent->GetName(); ?> - Admin</title>

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
			<link rel="stylesheet" href="../global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
			<link rel="stylesheet" href="../global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">


		<!-- Fonts -->
		<link rel="stylesheet" href="../global/fonts/material-design/material-design.min.css">
		<link rel="stylesheet" href="../global/fonts/web-icons/web-icons.min.css">
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

		<!-- Script for Ajax -->
		<script>

		function displayVote(voteId) {
			var modal = document.getElementById("ModalWrapper");
			modal.classList.add("modal-primary");
			modal.classList.remove("modal-danger");

			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
				}
			};
			url = "../Ajax/ViewVote.php";
			url += "?call=display";
			url += "&VoteId=" + voteId;
			xmlhttp.open("GET", url, true);
			xmlhttp.send();

		}
		function deleteShowVote(voteId) {
			var modal = document.getElementById("ModalWrapper");
			modal.classList.remove("modal-success");
			modal.classList.add("modal-danger");

			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
				}
			};
			url = "../Ajax/ViewVote.php";
			url += "?call=deleteShow";
			url += "&VoteId=" + voteId;
			xmlhttp.open("GET", url, true);
			xmlhttp.send();

		}
		function deleteVote(voteId) {
			var modal = document.getElementById("ModalWrapper");
			modal.classList.add("modal-success");
			modal.classList.remove("modal-danger");

			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
				}
			};
			url = "../Ajax/ViewVote.php";
			url += "?call=delete";
			url += "&VoteId=" + voteId;
			xmlhttp.open("GET", url, true);
			xmlhttp.send();

		}
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
				<h1 class="page-title">View Votes</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">View Votes</li>
				</ol>
			</div>
			<div class="page-content">
					<div class="row">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Vote List</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
										<thead>
											<tr>
												<th>Name</th>
												<th>Candidate</th>
												<th>Election</th>
												<td>Action</td>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Name</th>
												<th>Candidate</th>
												<th>Election</th>
												<td>Action</td>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$lstVote = $clsVote->Get();
											foreach($lstVote as $mdlVote)
											{
											?>
											<tr id="trMessage<?php echo $mdlVote->getId(); ?>">
												<td><?php echo $clsUser->GetNameById($mdlVote->getUser_Id()); ?></td>
												<td><?php echo $clsUser->getNameById($clsCandidate->getUser_IdById($mdlVote->getCandidate_Id()))," - ",$clsCandidatePosition->getNameById($clsCandidate->getCandidatePosition_IdById($mdlVote->getCandidate_Id())); ?></td>
												<td><?php echo $clsElection->GetNameById($mdlVote->getElection_Id()); ?></td>
												<td>
													<span data-toggle="modal" data-target="#ModalWrapper" onclick="displayVote(<?php echo $mdlVote->getId(); ?>);">
														<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="View">
															<i class="icon wb-eye" aria-hidden="true"></i>
														</a>
													</span>

													<a href="EditVote.php?Id=<?php echo $mdlVote->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
														<i class="icon wb-edit" aria-hidden="true"></i>
													</a>

													<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShowVote(<?php echo $mdlVote->getId(); ?>);">
														<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Remove">
															<i class="icon wb-trash" aria-hidden="true"></i>
														</a>
													</span>
												</td>
											</tr>
											<?php
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page -->


		<!-- Footer -->
		<?php include "footer.php"; ?>


		<!-- Modal -->
		<div class="modal fade" id="ModalWrapper" aria-hidden="true" aria-labelledby="ModalWrapper" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="modalContent">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">Modal Title</h4>
					</div>
					<div class="modal-body">
						<p>One fine body…</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal -->


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
			<script src="../global/vendor/datatables.net/jquery.dataTables.js"></script>
			<script src="../global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
			<script src="../global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
			<script src="../global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
			<script src="../global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
			<script src="../global/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
			<script src="../global/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
			<script src="../global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
			<script src="../global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
			<script src="../global/vendor/datatables.net-buttons/buttons.html5.js"></script>
			<script src="../global/vendor/datatables.net-buttons/buttons.flash.js"></script>
			<script src="../global/vendor/datatables.net-buttons/buttons.print.js"></script>
			<script src="../global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
			<script src="../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>
			<script src="../global/vendor/asrange/jquery-asRange.min.js"></script>
			<script src="../global/vendor/bootbox/bootbox.js"></script>

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
		<script src="assets/js/config/tour.js"></script>
		<script>Config.set('assets', 'assets');</script>

		<!-- Page -->
		<script src="assets/js/Site.js"></script>
		<script src="../global/js/Plugin/asscrollable.js"></script>
		<script src="../global/js/Plugin/slidepanel.js"></script>
		<script src="../global/js/Plugin/switchery.js"></script>
			<script src="../global/js/Plugin/datatables.js"></script>

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
