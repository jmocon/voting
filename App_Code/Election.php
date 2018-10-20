<?php
$clsElection = new Election();
class Election{

	private $table = "election";

	public function Election(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Election_Name`,
					`Election_Description`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlDescription()."'
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
			`Election_Name`='".$mdl->getsqlName()."',
			`Election_Description`='".$mdl->getsqlDescription()."'
			WHERE `Election_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}


	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Election_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Election_Id` FROM `".$this->table."`
				WHERE
				`Election_Name` = '".$mdl->getsqlName()."' AND
				`Election_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		if($num_rows > 0)
		{
			return true;
		}

		return false;
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
				WHERE `Election_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Election_Name` FROM `".$this->table."`
				WHERE `Election_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Election_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetOngoing(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `En`.* FROM `".$this->table."` AS `En`
				INNER JOIN `Event` AS `Et`
				ON `Et`.`Election_Id`= `En`.`Election_Id`
				WHERE `Et`.`Event_StartTrigger` = '1'
				AND `Et`.`Event_EndTrigger` = '0'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function CountAllRow(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Election_Id` FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		return $num_rows;
	}

	public function SetImage($image,$devId){
		$val = true; // true - upload success | false - upload failed
		$msg = ""; // error message
		$clsImage = new Image();

		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,"billing",$devId);
			if($result[0] == ""){
				$imgId = $result[1];
				$clsImage->ResizeW($imgId,"300");
				$clsImage->ResizeW($imgId,"100");
				$clsImage->ResizeH($imgId,"70");
				$clsImage->Resize($imgId,"50");
			}else{
				$msg = $result[0];
			}
		}

		return array("val"=>$val,"msg"=>$msg);
	}

	public function ModelTransfer($result){

		$mdl = new ElectionModel();
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
			$mdl = new ElectionModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new ElectionModel();

		$mdl->setId((isset($row['Election_Id'])) ? $row['Election_Id'] : '');
		$mdl->setName((isset($row['Election_Name'])) ? $row['Election_Name'] : '');
		$mdl->setDescription((isset($row['Election_Description'])) ? $row['Election_Description'] : '');
		$mdl->setDateCreated((isset($row['Election_DateCreated'])) ? $row['Election_DateCreated'] : '');
		return $mdl;
	}
}
?>
