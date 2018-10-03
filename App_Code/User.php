<?php
$clsUser = new User();
class User{

	private $table = "user";

	public function User(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$hashPassword = md5($mdl->getsqlPassword());

		$sql = "INSERT INTO `".$this->table."`
				(
					`UserType_Id`,
					`User_PrcId`,
					`User_FirstName`,
					`User_MiddleName`,
					`User_LastName`,
					`User_SuffixName`,
					`User_BirthDate`,
					`Gender_Id`,
					`User_MobileNumber`,
					`User_TelephoneNumber`,
					`User_HomeAddress`,
					`User_EmailAddress`,
					`User_Facebook`,
					`User_Twitter`,
					`User_GooglePlus`,
					`User_LinkedIn`,
					`User_Username`,
					`User_Password`
				) VALUES (
					'".$mdl->getsqlUserType_Id()."',
					'".$mdl->getsqlPrcId()."',
					'".$mdl->getsqlFirstName()."',
					'".$mdl->getsqlMiddleName()."',
					'".$mdl->getsqlLastName()."',
					'".$mdl->getsqlSuffixName()."',
					'".date_format(date_create($mdl->getsqlBirthDate()),"Y-m-d")."',
					'".$mdl->getsqlGender_Id()."',
					'".$mdl->getsqlMobileNumber()."',
					'".$mdl->getsqlTelephoneNumber()."',
					'".$mdl->getsqlHomeAddress()."',
					'".$mdl->getsqlEmailAddress()."',
					'".$mdl->getsqlFacebook()."',
					'".$mdl->getsqlTwitter()."',
					'".$mdl->getsqlGooglePlus()."',
					'".$mdl->getsqlLinkedIn()."',
					'".$mdl->getsqlUsername()."',
					'".$hashPassword."'
				)";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);

		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$hashPassword = "";
		// Check Changes in Password

		$sql="SELECT `User_Password` FROM `".$this->table."`
			WHERE `User_Id` = '".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result)){
			if($mdl->getsqlPassword() == $row['User_Password']){
				$hashPassword = $mdl->getsqlPassword();
			}else{
				$hashPassword = md5($mdl->getsqlPassword());
			}
		}


		$sql="UPDATE `".$this->table."` SET
			`UserType_Id`='".$mdl->getsqlUserType_Id()."',
			`User_PrcId`='".$mdl->getsqlPrcId()."',
			`User_FirstName`='".$mdl->getsqlFirstName()."',
			`User_MiddleName`='".$mdl->getsqlMiddleName()."',
			`User_LastName`='".$mdl->getsqlLastName()."',
			`User_SuffixName`='".$mdl->getsqlSuffixName()."',
			`User_BirthDate`='".date_format(date_create($mdl->getsqlBirthDate()),"Y-m-d")."',
			`Gender_Id`='".$mdl->getsqlGender_Id()."',
			`User_MobileNumber`='".$mdl->getsqlMobileNumber()."',
			`User_TelephoneNumber`='".$mdl->getsqlTelephoneNumber()."',
			`User_HomeAddress`='".$mdl->getsqlHomeAddress()."',
			`User_EmailAddress`='".$mdl->getsqlEmailAddress()."',
			`User_Facebook`='".$mdl->getsqlFacebook()."',
			`User_Twitter`='".$mdl->getsqlTwitter()."',
			`User_GooglePlus`='".$mdl->getsqlGooglePlus()."',
			`User_LinkedIn`='".$mdl->getsqlLinkedIn()."',
			`User_Username`='".$mdl->getsqlUsername()."',
			`User_Password`='".$hashPassword."'
			WHERE `User_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`User_Status`='0'
			WHERE `User_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`User_Status`='1'
			WHERE `User_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// PrcId
		if($mdl->getsqlPrcId() != ""){
			$sql = "SELECT `User_Id` FROM `".$this->table."`
					WHERE `User_PrcId` = '".$mdl->getsqlPrcId()."' AND `User_Id` != '".$mdl->getsqlId()."'";
			$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$num_rows = mysqli_num_rows($result);

			if($num_rows > 0)
			{
				$msg .= "<p>PRC Id: " . $mdl->getPrcId() . "</p>";
				$val = true;
			}
		}

		// MobileNumber
		if($mdl->getsqlMobileNumber() != ""){
			$sql = "SELECT `User_Id` FROM `".$this->table."`
					WHERE `User_MobileNumber` = '".$mdl->getsqlMobileNumber()."' AND `User_Id` != '".$mdl->getsqlId()."'";
			$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$num_rows = mysqli_num_rows($result);

			if($num_rows > 0)
			{
				$msg .= "<p>Mobile Number: " . $mdl->getMobileNumber() . "</p>";
				$val = true;
			}
		}

		// Email Address
		$sql = "SELECT `User_Id` FROM `".$this->table."`
				WHERE `User_EmailAddress` = '".$mdl->getsqlEmailAddress()."' AND `User_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		if($num_rows > 0)
		{
			$msg .= "<p>Email Address: " . $mdl->getEmailAddress() . "</p>";
			$val = true;
		}

		// Username
		$sql = "SELECT `User_Id` FROM `".$this->table."`
				WHERE `User_Username` = '".$mdl->getsqlUsername()."' AND `User_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		if($num_rows > 0)
		{
			$msg .= "<p>Username: " . $mdl->getUsername() . "</p>";
			$val = true;
		}

		mysqli_close($conn);
		return array("val"=>$val,"msg"=>$msg);
	}

	public function Login($username, $password){

		$Database = new Database();
		$conn = $Database->GetConn();

		$userId = "";
		$userTypeId = "";

		$username = mysqli_real_escape_string($conn,$username);
		$password = mysqli_real_escape_string($conn,$password);
		$password = md5($password);

		$sql = "SELECT `User_Id`,`UserType_Id` FROM `".$this->table."`
				WHERE
				`User_Username` = '".$username."' AND
				`User_Password` = '".$password."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$userId = $row['User_Id'];
			$userTypeId = $row['UserType_Id'];
		}

		mysqli_close($conn);
		return array("User_Id"=>$userId, "UserType_Id"=>$userTypeId);
	}

	public function Get(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByUserType_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `UserType_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetUserTypeIdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name="";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT
				`User_FirstName`,
				`User_MiddleName`,
				`User_LastName`,
				`User_SuffixName`
				FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$name = $row['User_FirstName'] . " " . $row['User_MiddleName'] . " " . $row['User_LastName'] . " " . $row['User_SuffixName'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function CheckSession($page){

		$Database = new Database();
		$conn = $Database->GetConn();

		$userType = "";

		$id = (isset($_SESSION['uid']))?$_SESSION['uid']:'';
		$id = mysqli_real_escape_string($conn,$id);

		$sql = "SELECT `UserType_Id` FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$userType = $row['UserType_Id'];
		}

		mysqli_close($conn);

		if($page == 'admin'){
			if($userType == 1){
			}else if($userType == 2){
				header('Location: ../member/index.php');
				die();
			}else{
				header('Location: ../login.php');
				exit;
			}
		}else if($page == 'member'){
			if($userType == 1){
				header('Location: ../admin/index.php');
				die();
			}else if($userType == 2){
			}else{
				header('Location: ../login.php');
				exit;
			}
		}else if($page == 'login'){
			if($userType == 1){
				header('Location: admin/index.php');
				die();
			}else if($userType == 2){
				header('Location: member/index.php');
				die();
			}
		}else{
			echo 'unknown page';
			die();
		}
	}

	public function CountAllRow(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `User_Id` FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		return $num_rows;
	}

	public function ToName($mdl){
		$name = $mdl->getFirstName() . " " . $mdl->getMiddleName() . " " . $mdl->getLastName() . " " . $mdl->getSuffixName();
		return $name;
	}

	public function SetImage($image,$userId){
		$val = true; // true - upload success | false - upload failed
		$msg = ""; // error message
		$clsImage = new Image();

		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,"user",$userId);
			if($result[0] == ""){
				$imgId = $result[1];
				$clsImage->Resize($imgId,"150");
				$clsImage->ResizeH($imgId,"70");
				$clsImage->Resize($imgId,"30");
			}else{
				$msg = $result[0];
			}
		}

		return array("val"=>$val,"msg"=>$msg);
	}

	public function ModelTransfer($result){

		$mdl = new UserModel();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = $this->ToModel($row);
		}
		return $mdl;
	}

	public function ListTransfer($result){

		$lst = array();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = new UserModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UserModel();

		$mdl->setId((isset($row['User_Id'])) ? $row['User_Id'] : '');
		$mdl->setUserType_Id((isset($row['UserType_Id'])) ? $row['UserType_Id'] : '');
		$mdl->setPrcId((isset($row['User_PrcId'])) ? $row['User_PrcId'] : '');
		$mdl->setFirstName((isset($row['User_FirstName'])) ? $row['User_FirstName'] : '');
		$mdl->setMiddleName((isset($row['User_MiddleName'])) ? $row['User_MiddleName'] : '');
		$mdl->setLastName((isset($row['User_LastName'])) ? $row['User_LastName'] : '');
		$mdl->setSuffixName((isset($row['User_SuffixName'])) ? $row['User_SuffixName'] : '');
		$mdl->setBirthDate((isset($row['User_BirthDate'])) ? $row['User_BirthDate'] : '');
		$mdl->setGender_Id((isset($row['Gender_Id'])) ? $row['Gender_Id'] : '');
		$mdl->setMobileNumber((isset($row['User_MobileNumber'])) ? $row['User_MobileNumber'] : '');
		$mdl->setTelephoneNumber((isset($row['User_TelephoneNumber'])) ? $row['User_TelephoneNumber'] : '');
		$mdl->setHomeAddress((isset($row['User_HomeAddress'])) ? $row['User_HomeAddress'] : '');
		$mdl->setEmailAddress((isset($row['User_EmailAddress'])) ? $row['User_EmailAddress'] : '');
		$mdl->setFacebook((isset($row['User_Facebook'])) ? $row['User_Facebook'] : '');
		$mdl->setTwitter((isset($row['User_Twitter'])) ? $row['User_Twitter'] : '');
		$mdl->setGooglePlus((isset($row['User_GooglePlus'])) ? $row['User_GooglePlus'] : '');
		$mdl->setLinkedIn((isset($row['User_LinkedIn'])) ? $row['User_LinkedIn'] : '');
		$mdl->setUsername((isset($row['User_Username'])) ? $row['User_Username'] : '');
		$mdl->setPassword((isset($row['User_Password'])) ? $row['User_Password'] : '');
		$mdl->setDateCreated((isset($row['User_DateCreated'])) ? $row['User_DateCreated'] : '');
		$mdl->setStatus((isset($row['User_Status'])) ? $row['User_Status'] : '');

		return $mdl;
	}
}
?>
