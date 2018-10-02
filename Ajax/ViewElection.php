<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");

require_once '../global/htmlpurifier/library/HTMLPurifier.auto.php';

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayElection($_GET['Id']);
		break;
	}
	case 'deleteShow':
	{
		deleteShow($_GET['Id']);
		break;
	}
	case 'deleteElection':
	{
		deleteElection($_GET['Id']);
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
		<h3 class="modal-title">Featured Election</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Election Added to Featured</h4>
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
		<h3 class="modal-title">Featured Election</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Election Removed from Featured</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function displayElection($electionId)
{
	$clsElection = new Election();
	$mdlElection = new ElectionModel();

	$purifier = new HTMLPurifier();

	$mdlElection = $clsElection->GetById($electionId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Election Detail</h3>
	</div>
	<div class="modal-body">

		<div class="row">
			<div class="col-md-12">
				<h4>Election Details</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlElection->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description:
			</div>
			<div class="col-md-8">
				<?php echo $purifier->purify($mdlElection->getDescription()); ?>
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
	$clsElection = new Election();

	$mdlElection = $clsElection->GetById($id);
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
				<h4>Election Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlElection->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description:
			</div>
			<div class="col-md-8">
				<?php echo $mdlElection->getDescription(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteElection(<?php echo $mdlElection->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteElection($id)
{
	$clsElection = new Election();
	$clsImage = new Image();
	$clsElection->Delete($id);
	$clsImage->DeleteByTableTableId('election',$id);
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
	$clsElection = new Election();
	$clsElection->Activate($id);
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
	$clsElection = new Election();
	$clsElection->Deactivate($id);
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
