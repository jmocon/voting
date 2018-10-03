<?php
$clsMessages = new Messages();
class Messages{

	private $table = "messages";

	public function Messages(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Property_Id`,
					`User_Id`,
					`Messages_Name`,
					`Messages_Email`,
					`Messages_Phone`,
					`Messages_Subject`,
					`Messages_Message`
				) VALUES (
					'".$mdl->getsqlProperty_Id()."',
					'".$mdl->getsqlUser_Id()."',
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlEmail()."',
					'".$mdl->getsqlPhone()."',
					'".$mdl->getsqlSubject()."',
					'".$mdl->getsqlMessage()."'
				)";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);

		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="UPDATE `".$this->table."` SET
			`Property_Id`='".$mdl->getsqlProperty_Id()."',
			`User_Id`='".$mdl->getsqlUser_Id()."',
			`Messages_Name`='".$mdl->getsqlName()."',
			`Messages_Email`='".$mdl->getsqlEmail()."',
			`Messages_Phone`='".$mdl->getsqlPhone()."',
			`Messages_Subject`='".$mdl->getsqlSubject()."',
			`Messages_Messages`='".$mdl->getsqlMessages()."',
			`Messages_Read`='".$mdl->getsqlRead()."',
			`Messages_DateCreated`='".$mdl->getsqlDateCreated()."',
			`Messages_Status`='".$mdl->getsqlStatus()."'
			WHERE `Messages_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Read($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Messages_Read`='1'
			WHERE `Messages_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}
	
	public function Unread($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Messages_Read`='0'
			WHERE `Messages_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Messages_Status`='0'
			WHERE `Messages_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}
	
	public function Deactivate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Messages_Status`='1'
			WHERE `Messages_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}
	
	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Messages_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
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
				WHERE `Messages_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByPropertyId($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Property_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUserId($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}
	
	public function CountAllRow(){
		
		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Messages_Id` FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		return $num_rows;
	}
	
	public function CountByUser_Id($userId){
		
		$Database = new Database();
		$conn = $Database->GetConn();

		$userId = mysqli_real_escape_string($conn,$userId);
		$sql = "SELECT `Messages_Id` FROM `".$this->table."` WHERE `User_Id`='".$userId."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		return $num_rows;
	}

	public function ModelTransfer($result){

		$mdl = new MessagesModel();
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
			$mdl = new MessagesModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new MessagesModel();
		
		$mdl->setId((isset($row['Messages_Id'])) ? $row['Messages_Id'] : '');
		$mdl->setProperty_Id((isset($row['Property_Id'])) ? $row['Property_Id'] : '');
		$mdl->setUser_Id((isset($row['User_Id'])) ? $row['User_Id'] : '');
		$mdl->setName((isset($row['Messages_Name'])) ? $row['Messages_Name'] : '');
		$mdl->setEmail((isset($row['Messages_Email'])) ? $row['Messages_Email'] : '');
		$mdl->setPhone((isset($row['Messages_Phone'])) ? $row['Messages_Phone'] : '');
		$mdl->setSubject((isset($row['Messages_Subject'])) ? $row['Messages_Subject'] : '');
		$mdl->setMessage((isset($row['Messages_Message'])) ? $row['Messages_Message'] : '');
		$mdl->setRead((isset($row['Messages_Read'])) ? $row['Messages_Read'] : '');
		$mdl->setDateCreated((isset($row['Messages_DateCreated'])) ? $row['Messages_DateCreated'] : '');
		$mdl->setStatus((isset($row['Messages_Status'])) ? $row['Messages_Status'] : '');
		return $mdl;
	}
}
?>