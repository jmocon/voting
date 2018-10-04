<?php
require_once ("../App_Code/Database.php");
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

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayVote($_GET['VoteId']);
		break;
	}
	case 'editShow':
	{
		editShowVote($_GET['VoteId']);
		break;
	}
	case 'edit':
	{
		editVote($_GET['VoteId']);
		break;
	}
	case 'deleteShow':
	{
		deleteShowVote($_GET['VoteId']);
		break;
	}
	case 'delete':
	{
		deleteVote($_GET['VoteId']);
		break;
	}
}

function displayVote($voteId)
{
	$clsVote = new Vote();
	$mdlVote = new VoteModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
	$clsCandidate = new Candidate();
	$mdlCandidate = new CandidateModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
  $clsCandidatePosition = new CandidatePosition();
	$mdlCandidatePosition = new CandidatePositionModel();
	$mdlVote = $clsVote->GetById($voteId);

	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Vote Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				Voter Name
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlVote->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Candidate
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->getNameById($clsCandidate->getUser_IdById($mdlVote->getCandidate_Id())); ?>
		</div>
		<div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlVote->getElection_Id()); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShowVote($voteId)
{
	$clsVote = new Vote();
	$mdlVote = new VoteModel();
	$clsCandidate = new Candidate();
	$mdlCandidate = new CandidateModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
  $clsCandidatePosition = new CandidatePosition();
	$mdlCandidatePosition = new CandidatePositionModel();
	$mdlVote = $clsVote->GetById($voteId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Vote</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h4>Vote Detail</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Voter Name
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlVote->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Candidate
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlCandidate->getUser_Id())," - ",$clsCandidatePosition->GetNameById($mdlCandidate->getCandidatePosition_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlVote->getElection_Id()); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteVote(<?php echo $mdlVote->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteVote($voteId)
{
	$clsVote = new Vote();
	$clsVote->Delete($voteId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Vote</h3>
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
