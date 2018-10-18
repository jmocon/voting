<?php
$clsEvent = new Event();
class Event{

	private $table = "event";

	public function Event(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Event_Type`,
					`Event_StartDateTime`,
					`Event_EndDateTime`,
					`Election_Id`
				) VALUES (
					'".$mdl->getsqlType()."',
					'".date_format(date_create($mdl->getsqlStartDateTime()),"Y-m-d")."',
					'".date_format(date_create($mdl->getsqlEndDateTime()),"Y-m-d")."',
					'".$mdl->getsqlElection_Id()."'
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
			`Event_Type`='".$mdl->getsqlType()."',
			`Event_StartDateTime`='".date_format(date_create($mdl->getsqlStartDateTime()),"Y-m-d")."',
			`Event_EndDateTime`='".date_format(date_create($mdl->getsqlEndDateTime()),"Y-m-d")."',
			`Election_Id`='".$mdl->Election_Id()."'
			WHERE `Event_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Neutral($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Event_StartTrigger`='0',
			`Event_EndTrigger`='0'
			WHERE `Event_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
      `Event_StartTrigger`='1',
			`Event_EndTrigger`='0'
			WHERE `Event_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
      `Event_StartTrigger`='1',
      `Event_EndTrigger`='1'
			WHERE `Event_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Event_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

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
				WHERE `Event_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByElection_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Election_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetElectionIdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Event_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetTypeById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name="";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT
				`Event_Type`
				FROM `".$this->table."`
				WHERE `Event_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	}

	public function CountAllRow(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Event_Id` FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);
		return $num_rows;
	}

	public function ModelTransfer($result){

		$mdl = new EventModel();
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
			$mdl = new EventModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new EventModel();

		$mdl->setId((isset($row['Event_Id'])) ? $row['Event_Id'] : '');
		$mdl->setType((isset($row['Event_Type'])) ? $row['Event_Type'] : '');
		$mdl->setStartDateTime((isset($row['Event_StartDateTime'])) ? $row['Event_StartDateTime'] : '');
		$mdl->setStartTrigger((isset($row['Event_StartTrigger'])) ? $row['Event_StartTrigger'] : '');
		$mdl->setEndDateTime((isset($row['Event_EndDateTime'])) ? $row['Event_EndDateTime'] : '');
		$mdl->setEndTrigger((isset($row['Event_EndTrigger'])) ? $row['Event_EndTrigger'] : '');
		$mdl->setElection_Id((isset($row['Election_Id'])) ? $row['Election_Id'] : '');
		$mdl->setDateCreated((isset($row['Event_DateCreated'])) ? $row['Event_DateCreated'] : '');

		return $mdl;
	}
}
?>
