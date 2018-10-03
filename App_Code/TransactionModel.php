<?php
$mdlTransaction = new TransactionModel();
class TransactionModel{

	private $Id = "";
	private $Billing_Id = "";
  private $User_Id = "";
  private $DatePaid = "";
  private $DateCreated = "";


	public function TransactionModel(){}

	public function getId(){
		return $this->Id;
	}

	public function getsqlId(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Id);
		mysqli_close($conn);
		return $value;
	}

	public function setId($Id){
		$this->Id = $Id;
	}



	public function getBilling_Id(){
		return $this->Billing_Id;
	}

	public function getsqlBilling_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Billing_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setBilling_Id($Billing_Id){
		$this->Billing_Id = $Billing_Id;
	}



	public function getUser_Id(){
		return $this->User_Id;
	}

	public function getsqlUser_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->User_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUser_Id($User_Id){
		$this->User_Id = $User_Id;
	}



	public function getDatePaid(){
		return $this->DatePaid;
	}

	public function getsqlDatePaid(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->DatePaid);
		mysqli_close($conn);
		return $value;
	}

	public function setDatePaid($DatePaid){
		$this->DatePaid = $DatePaid;
	}



	public function getDateCreated(){
		return $this->DateCreated;
	}

	public function getsqlDateCreated(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->DateCreated);
		mysqli_close($conn);
		return $value;
	}

	public function setDateCreated($DateCreated){
		$this->DateCreated = $DateCreated;
	}

}
