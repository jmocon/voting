<?php
$clsCandidatePosition = new CandidatePosition();
class CandidatePosition{

	private $table = "candidateposition";

	public function CandidatePosition(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`CandidatePosition_Name`,
					`CandidatePosition_MaxVote`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlMaxVote()."'
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
			`CandidatePosition_Name`='".$mdl->getsqlName()."',
			`CandidatePosition_MaxVote`='".$mdl->getsqlMaxVote()."'
			WHERE `CandidatePosition_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}


	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `CandidatePosition_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `CandidatePosition_Id` FROM `".$this->table."`
				WHERE
				`CandidatePosition_Name` = '".$mdl->getsqlName()."' AND
				`CandidatePosition_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `CandidatePosition_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `CandidatePosition_Name` FROM `".$this->table."`
				WHERE `CandidatePosition_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['CandidatePosition_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function CountAllRow(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `CandidatePosition_Id` FROM `".$this->table."`";
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
			$result = $clsImage->Upload($image,"candidateposition",$devId);
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

		$mdl = new CandidatePositionModel();
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
			$mdl = new CandidatePositionModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new CandidatePositionModel();

		$mdl->setId((isset($row['CandidatePosition_Id'])) ? $row['CandidatePosition_Id'] : '');
		$mdl->setName((isset($row['CandidatePosition_Name'])) ? $row['CandidatePosition_Name'] : '');
		$mdl->setMaxVote((isset($row['CandidatePosition_MaxVote'])) ? $row['CandidatePosition_MaxVote'] : '');
		return $mdl;
	}
}
?>
