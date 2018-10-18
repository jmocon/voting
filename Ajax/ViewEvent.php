<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Event.php");
require_once ("../App_Code/EventModel.php");
require_once ("../App_Code/Election.php");
require_once ("../App_Code/ElectionModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'start':
	{
		startEvent($_GET['EventId']);
		break;
	}
	case 'stop':
	{
		stopEvent($_GET['EventId']);
		break;
	}
	case 'display':
	{
		displayEvent($_GET['EventId']);
		break;
	}
	case 'editShow':
	{
		editShowEvent($_GET['EventId']);
		break;
	}
	case 'edit':
	{
		editEvent($_GET['EventId']);
		break;
	}
	case 'deleteShow':
	{
		deleteShowEvent($_GET['EventId']);
		break;
	}
	case 'delete':
	{
		deleteEvent($_GET['EventId']);
		break;
	}
	case 'publish':
	{
		publish($_GET['EventId']);
		break;
	}
	case 'unpublish':
	{
		unpublish($_GET['EventId']);
		break;
	}
}

function startEvent($eventId)
{
	$clsEvent = new Event();
	$clsEvent->Activate($eventId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Event</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Event has Started</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function stopEvent($eventId)
{
	$clsEvent = new Event();
	$clsEvent->Deactivate($eventId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Event</h3>
	</div>
	<div class="modal-body">
		<h4 class="card-title">Event has Ended</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function displayEvent($eventId)
{
	$clsEvent = new Event();
	$mdlEvent = new EventModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlEvent = $clsEvent->GetById($eventId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Event Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlEvent->getElection_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Type
			</div>
			<div class="col-md-8">
				<?php
        switch ($mdlEvent->getType()) {
          case "0":
            echo 'Manual';
            break;
          case "1":
            echo 'Automatic';
            break;
        }
        ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Start Date
			</div>
			<div class="col-md-8">
				<?php echo $mdlEvent->getStartDateTime(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				End Date
			</div>
			<div class="col-md-8">
				<?php echo $mdlEvent->getEndDateTime() ?>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShowEvent($eventId)
{
	$clsEvent = new Event();
	$mdlEvent = new EventModel();
	$clsElection = new Election();
	$mdlElection = new ElectionModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlEvent = $clsEvent->GetById($eventId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Event</h3>
	</div>
	<div class="modal-body">
    <div class="row">
			<div class="col-md-4">
				Election
			</div>
			<div class="col-md-8">
				<?php echo $clsElection->GetNameById($mdlEvent->getElection_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Type
			</div>
			<div class="col-md-8">
				<?php
        switch ($mdlEvent->getType()) {
          case "0":
            echo 'Manual';
            break;
          case "1":
            echo 'Automatic';
            break;
        }
        ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Start Date
			</div>
			<div class="col-md-8">
				<?php echo $mdlEvent->getStartDateTime(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				End Date
			</div>
			<div class="col-md-8">
				<?php echo $mdlEvent->getEndDateTime() ?>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteEvent(<?php echo $mdlEvent->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteEvent($eventId)
{
	$clsEvent = new Event();
	$clsEvent->Delete($eventId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete Event</h3>
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

function publish($eventId)
{
	$clsEvent = new Event();
	$clsEvent->Activate($id);
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

function unpublish($eventId)
{
	$clsEvent = new Event();
	$clsEvent->Deactivate($eventId);
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
