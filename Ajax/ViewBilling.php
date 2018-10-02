<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Billing.php");
require_once ("../App_Code/BillingModel.php");

require_once '../global/htmlpurifier/library/HTMLPurifier.auto.php';

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayBilling($_GET['Id']);
		break;
	}
	case 'deleteShow':
	{
		deleteShow($_GET['Id']);
		break;
	}
	case 'deleteBilling':
	{
		deleteBilling($_GET['Id']);
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
		<h3 class="modal-title">Featured Billing</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Billing Added to Featured</h4>
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
		<h3 class="modal-title">Featured Billing</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Billing Removed from Featured</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function displayBilling($billingId)
{
	$clsBilling = new Billing();
	$mdlBilling = new BillingModel();

	$purifier = new HTMLPurifier();

	$mdlBilling = $clsBilling->GetById($billingId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Billing Detail</h3>
	</div>
	<div class="modal-body">

		<div class="row">
			<div class="col-md-12">
				<h4>Billing Details</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlBilling->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description:
			</div>
			<div class="col-md-8">
				<?php echo $purifier->purify($mdlBilling->getDescription()); ?>
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
	$clsBilling = new Billing();

	$mdlBilling = $clsBilling->GetById($id);
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
				<h4>Billing Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlBilling->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description:
			</div>
			<div class="col-md-8">
				<?php echo $mdlBilling->getDescription(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteBilling(<?php echo $mdlBilling->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteBilling($id)
{
	$clsBilling = new Billing();
	$clsImage = new Image();
	$clsBilling->Delete($id);
	$clsImage->DeleteByTableTableId('billing',$id);
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
	$clsBilling = new Billing();
	$clsBilling->Activate($id);
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
	$clsBilling = new Billing();
	$clsBilling->Deactivate($id);
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
