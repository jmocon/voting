<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/CandidatePosition.php");
require_once ("../App_Code/CandidatePositionModel.php");

require_once '../global/htmlpurifier/library/HTMLPurifier.auto.php';

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayCandidatePosition($_GET['Id']);
		break;
	}
	case 'deleteShow':
	{
		deleteShow($_GET['Id']);
		break;
	}
	case 'deleteCandidatePosition':
	{
		deleteCandidatePosition($_GET['Id']);
		break;
	}
}


function addFeature($id)
{
	$cls = new Featured();
	$mdl = new FeaturedModel();

	if(!($cls->IsExist($id))){
		$cls->Add($id);
	}
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Featured CandidatePosition</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">CandidatePosition Added to Featured</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function removeFeature($id)
{
	$cls = new Featured();
	$mdl = new FeaturedModel();

	$cls->Delete($id);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Featured CandidatePosition</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">CandidatePosition Removed from Featured</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function displayCandidatePosition($candidatepositionId)
{
	$clsCandidatePosition = new CandidatePosition();
	$mdlCandidatePosition = new CandidatePositionModel();

	$purifier = new HTMLPurifier();

	$mdlCandidatePosition = $clsCandidatePosition->GetById($candidatepositionId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">CandidatePosition Detail</h3>
	</div>
	<div class="modal-body">

		<div class="row">
			<div class="col-md-12">
				<h4>CandidatePosition Details</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlCandidatePosition->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShow($id)
{
	$clsCandidatePosition = new CandidatePosition();

	$mdlCandidatePosition = $clsCandidatePosition->GetById($id);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete </h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h4>CandidatePosition Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlCandidatePosition->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteCandidatePosition(<?php echo $mdlCandidatePosition->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteCandidatePosition($id)
{
	$clsCandidatePosition = new CandidatePosition();
	$clsImage = new Image();
	$clsCandidatePosition->Delete($id);
	$clsImage->DeleteByTableTableId('candidateposition',$id);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete </h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Deleted Successfully</h4>
		<p class="card-text">page auto refreshes in 5 sec.</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function publish($id)
{
	$clsCandidatePosition = new CandidatePosition();
	$clsCandidatePosition->Activate($id);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Publish</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Published Successfully</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function unpublish($id)
{
	$clsCandidatePosition = new CandidatePosition();
	$clsCandidatePosition->Deactivate($id);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Publish</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Unpublished Successfully</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}
?>
