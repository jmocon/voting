<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Transaction.php");
require_once ("../App_Code/TransactionModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Billing.php");
require_once ("../App_Code/BillingModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayTransaction($_GET['TransactionId']);
		break;
	}
	case 'deleteShow':
	{
		deleteShowTransaction($_GET['TransactionId']);
		break;
	}
	case 'delete':
	{
		deleteTransaction($_GET['TransactionId']);
		break;
	}
}

function displayTransaction($transactionId)
{
	$clsBilling = new Billing();
	$mdlBilling = new BillingModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsTransaction = new Transaction();
	$mdlTransaction = new TransactionModel();
	$mdlTransaction = $clsTransaction->GetById($transactionId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Transaction Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				Payer
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlTransaction->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Bill
			</div>
			<div class="col-md-8">
				<?php echo $clsBilling->GetNameById($mdlTransaction->getBilling_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Date Paid
			</div>
			<div class="col-md-8">
				<?php echo date_format(date_create($mdlTransaction->getsqlDatePaid()),"F j, Y"); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShowTransaction($transactionId)
{
	$clsBilling = new Billing();
	$mdlBilling = new BillingModel();
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsTransaction = new Transaction();
	$mdlTransaction = new TransactionModel();
	$mdlTransaction = $clsTransaction->GetById($transactionId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Transaction</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				Payer
			</div>
			<div class="col-md-8">
				<?php echo $clsUser->GetNameById($mdlTransaction->getUser_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Bill
			</div>
			<div class="col-md-8">
				<?php echo $clsBilling->GetNameById($mdlTransaction->getBilling_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Date Paid
			</div>
			<div class="col-md-8">
				<?php echo date_format(date_create($mdlTransaction->getsqlDatePaid()),"F j, Y"); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteTransaction(<?php echo $mdlTransaction->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteTransaction($transactionId)
{
	$clsTransaction = new Transaction();
	$clsTransaction->Delete($transactionId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Transaction</h3>
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
