<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Messages.php");
require_once ("../App_Code/MessagesModel.php");


$call = $_GET['call'];

switch ($call)
{
	case 'sendMessage':
	{
		sendMessage($_GET['UserId'],$_GET['PropertyId'],$_GET['Name'],$_GET['Email'],$_GET['Phone'],$_GET['Subject'],$_GET['Message']);
		break;
	}
}

function sendMessage($userId,$propertyId,$name,$email,$phone,$subject,$message)
{
	$clsMsg = new Messages();
	$mdlMsg = new MessagesModel();
	
	$mdlMsg->setProperty_Id($propertyId);
	$mdlMsg->setUser_Id($userId);
	$mdlMsg->setName($name);
	$mdlMsg->setEmail($email);
	$mdlMsg->setPhone($phone);
	$mdlMsg->setSubject($subject);
	$mdlMsg->setMessage($message);
	
	$clsMsg->Add($mdlMsg);
	?>
	<div class="modal-header text-center">
		<h4 class="w-full text-center">Message Sent</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

?>