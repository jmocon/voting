<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Candidate.php");
require_once ("../App_Code/CandidateModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/CandidatePosition.php");
require_once ("../App_Code/CandidatePositionModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayCandidate($_GET['CandidateId']);
		break;
	}
	case 'editShow':
	{
		editShowCandidate($_GET['CandidateId']);
		break;
	}
	case 'edit':
	{
		editCandidate($_GET['CandidateId']);
		break;
	}
	case 'deleteShow':
	{
		deleteShowCandidate($_GET['CandidateId']);
		break;
	}
	case 'delete':
	{
		deleteCandidate($_GET['CandidateId']);
		break;
	}
}

function displayCandidate($candidateId)
{
	$clsCandidate = new Candidate();
	$mdlCandidate = new CandidateModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
	$clsCandidatePosition = new CandidatePosition();
	$mdlCandidatePosition = new CandidatePositionModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlCandidate = $clsCandidate->GetById($candidateId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Candidate Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				Full Name
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlCandidate->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Candidate Position
			</div>
			<div class="col-md-8">
				<?php echo $clsCandidatePosition->GetNameById($mdlCandidate->getCandidatePosition_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlCandidate->getElection_Id()); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShowCandidate($candidateId)
{
	$clsCandidate = new Candidate();
	$mdlCandidate = new CandidateModel();
	$clsCandidatePosition = new CandidatePosition();
	$mdlCandidatePosition = new CandidatePositionModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
	$mdlCandidate = $clsCandidate->GetById($candidateId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Candidate</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h4>Personal Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Full Name
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlCandidate->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Candidate Position
			</div>
			<div class="col-md-8">
				<?php echo $clsCandidatePosition->GetNameById($mdlCandidate->getCandidatePosition_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlCandidate->getElection_Id()); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteCandidate(<?php echo $mdlCandidate->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteCandidate($candidateId)
{
	$clsCandidate = new Candidate();
	$clsCandidate->Delete($candidateId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Candidate</h3>
	</div>
	<div class="modal-body">
		<h4>Deleted Successfully</h4>
		<p>page auto refreshes in 5 sec.</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}
?>
