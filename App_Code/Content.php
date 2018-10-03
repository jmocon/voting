<?php
$clsContent = new Content();
class Content{

	private $table = "content";

	public function Content(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Content_Name`,
					`Content_Value`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlValue()."'
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
			`Content_Name`='".$mdl->getsqlName()."',
			`Content_Value`='".$mdl->getsqlValue()."'
			WHERE `Content_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateValueById($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$value = mysqli_real_escape_string($conn,$value);
		$sql="UPDATE `".$this->table."` SET
			`Content_Value`='".$value."'
			WHERE `Content_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}


	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Content_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Content_Id` FROM `".$this->table."`
				WHERE 
				`Content_Name` = '".$mdl->getsqlName()."' AND
				`Content_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Content_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByName($name){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = mysqli_real_escape_string($conn,$name);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Content_Name` = '".$name."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
		
		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Content_Name` FROM `".$this->table."`
				WHERE `Content_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Content_Name'];
		}
		
		mysqli_close($conn);
		
		return $name;
	}

	public function GetValueById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Content_Value` FROM `".$this->table."`
				WHERE `Content_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Content_Value'];
		}
		
		mysqli_close($conn);
		
		return $name;
	}

	public function GetValueByName($name){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$name = mysqli_real_escape_string($conn,$name);

		$sql="SELECT `Content_Value` FROM `".$this->table."`
				WHERE `Content_Name` = '".$name."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Content_Value'];
		}
		
		mysqli_close($conn);
		
		return $value;
	}

	public function GetName(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$sql="SELECT `Content_Value` FROM `".$this->table."`
				WHERE `Content_Name` = 'Name'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['Content_Value'];
		}
		mysqli_close($conn);
		
		return $value;
	}

	public function GetLogo(){

		$Database = new Database();
		$conn = $Database->GetConn();
		$clsImage = new Image();
		$value = "";
		$sql="SELECT `Content_Value` FROM `".$this->table."`
				WHERE `Content_Name` = 'Logo'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['Content_Value'];
		}
		mysqli_close($conn);
		$value = $clsImage->ToLocation($clsImage->GetById($value));
		return $value;
	}

	public function GetFavicon(){

		$Database = new Database();
		$conn = $Database->GetConn();
		$clsImage = new Image();
		$value = "";
		$sql="SELECT `Content_Value` FROM `".$this->table."`
				WHERE `Content_Name` = 'Favicon'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['Content_Value'];
		}
		mysqli_close($conn);
		$value = $clsImage->ToLocation($clsImage->GetById($value));
		return $value;
	}

	public function SetImage($image,$contentId){
		$val = true; // true - upload success | false - upload failed
		$msg = ""; // error message
		$clsImage = new Image();
		
		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,"content",$contentId);
			if($result[0] != ""){
				$msg = $result[0];
				$val = false;
			}else{
				$this->UpdateValueById($contentId,$result[1]);
			}
		}

		return array("val"=>$val,"msg"=>$msg);
	}


	public function ModelTransfer($result){

		$mdl = new ContentModel();
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
			$mdl = new ContentModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new ContentModel();

		$mdl->setId((isset($row['Content_Id'])) ? $row['Content_Id'] : '');
		$mdl->setName((isset($row['Content_Name'])) ? $row['Content_Name'] : '');
		return $mdl;
	}
}
?>