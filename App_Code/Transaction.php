<?php
$clsTransaction = new Transaction();
class Transaction{

	private $table = "transaction";

	public function Transaction(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Billing_Id`,
					`User_Id`,
  				`Transaction_DatePaid`,
					`Transaction_DateCreated`
				) VALUES (
					'".$mdl->getsqlBilling_Id()."',
					'".$mdl->getsqlUser_Id()."',
					'".date_format(date_create($mdl->getsqlDatePaid()),"Y-m-d")."',
					'".$mdl->getsqlDateCreated()."'
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
			`Billing_Id`='".$mdl->getsqlBilling_Id()."',
			`User_Id`='".$mdl->getsqlUser_Id()."',
			`Transaction_DatePaid`='".date_format(date_create($mdl->getsqlDatePaid()),"Y-m-d")."',
			`Transaction_DateCreated`='".$mdl->getsqlDateCreated()."'
			WHERE `Transaction_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}


	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Transaction_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Transaction_Id` FROM `".$this->table."`
				WHERE
				`Billing_Id` = '".$mdl->getsqlBilling_Id()."' AND
				`User_Id` = '".$mdl->getsqlUser_Id()."' AND
				`Transaction_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Transaction_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function CountAllRow(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT `Transaction_Id` FROM `".$this->table."`";
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

		$mdl = new TransactionModel();
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
			$mdl = new TransactionModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new TransactionModel();

		$mdl->setId((isset($row['Transaction_Id'])) ? $row['Transaction_Id'] : '');
		$mdl->setBilling_Id((isset($row['Billing_Id'])) ? $row['Billing_Id'] : '');
		$mdl->setUser_Id((isset($row['User_Id'])) ? $row['User_Id'] : '');
		$mdl->setDatePaid((isset($row['Transaction_DatePaid'])) ? $row['Transaction_DatePaid'] : '');
		$mdl->setDateCreated((isset($row['Transaction_DateCreated'])) ? $row['Transaction_DateCreated'] : '');
		return $mdl;
	}
}
?>
