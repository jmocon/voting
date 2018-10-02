<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/UserType.php");
require_once ("../App_Code/UserTypeModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/Gender.php");
require_once ("../App_Code/GenderModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		displayUser($_GET['UserId']);
		break;
	}
	case 'editShow':
	{
		editShowUser($_GET['UserId']);
		break;
	}
	case 'edit':
	{
		editUser($_GET['UserId']);
		break;
	}
	case 'deleteShow':
	{
		deleteShowUser($_GET['UserId']);
		break;
	}
	case 'delete':
	{
		deleteUser($_GET['UserId']);
		break;
	}
}

function displayUser($userId)
{
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsUT = new UserType();
	$mdlUT = new UserTypeModel();
	$clsGender = new Gender();
	$mdlGender = new GenderModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlUser = $clsUser->GetById($userId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">User Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"150");
				foreach($lstImage as $mdlImage){
					?>
					<img src="../<?php echo $clsImage->ToLocation($mdlImage); ?>" class="img-fluid h-150 img-bordered" />
					<?php
				}
				?>
			</div>
		</div>
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
				<?php
				$fullName = "";
				$fullName .= $mdlUser->getFirstName();
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= ($mdlUser->getMiddleName() != '')? $mdlUser->getMiddleName():'';
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= $mdlUser->getLastName();
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= $mdlUser->getSuffixName();
				echo $fullName; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Prc Id
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getPrcId(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Date of Birth
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getBirthDate(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Gender
			</div>
			<div class="col-md-8">
				<?php echo $clsGender->GetNameById($mdlUser->getGender_Id()); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4>Contact Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Email Address
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getEmailAddress(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Mobile Number
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getMobileNumber(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Telephone Number
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getTelephoneNumber(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Home Address
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getHomeAddress(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4>Social Networks</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Facebook
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getFacebook(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Twitter
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getTwitter(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				GooglePlus
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getGooglePlus(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				LinkedIn
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getLinkedIn(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4>Account Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				User Type
			</div>
			<div class="col-md-8">
				<?php echo $clsUT->GetNameById($mdlUser->getUserType_Id()); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Username
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getUsername(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShowUser($userId)
{
	$clsUser = new User();
	$mdlUser = new UserModel();
	$clsGender = new Gender();
	$mdlGender = new GenderModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlUser = $clsUser->GetById($userId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete User</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"150");
				foreach($lstImage as $mdlImage){
					?>
					<img src="../<?php echo $clsImage->ToLocation($mdlImage); ?>" class="img-fluid h-150 img-bordered" />
					<?php
				}
				?>
			</div>
		</div>
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
				<?php
				$fullName = "";
				$fullName .= $mdlUser->getFirstName();
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= ($mdlUser->getMiddleName() != '')? $mdlUser->getMiddleName():'';
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= $mdlUser->getLastName();
				$fullName .= ($fullName != '')? " ":'';
				$fullName .= $mdlUser->getSuffixName();
				echo $fullName; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Email Address
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getEmailAddress(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Mobile Number
			</div>
			<div class="col-md-8">
				<?php echo $mdlUser->getMobileNumber(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteUser(<?php echo $mdlUser->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteUser($userId)
{
	$clsUser = new User();
	$clsUser->Delete($userId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Delete User</h3>
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
