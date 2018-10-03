<?php
$mdlImage = new ImageModel();
class ImageModel{

	private $Id = "";
	private $Name = "";
	private $Table = "";
	private $TableId = "";
	private $Size = "";
	private $DateCreated = "";
	private $Status = ""; // 0 - active, 1 - inactive


	public function ImageModel(){}
	
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



	public function getName(){
		return $this->Name;
	}

	public function getsqlName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Name);
		mysqli_close($conn);
		return $value;
	}

	public function setName($Name){
		$this->Name = $Name;
	}



	public function getTable(){
		return $this->Table;
	}

	public function getsqlTable(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Table);
		mysqli_close($conn);
		return $value;
	}

	public function setTable($Table){
		$this->Table = $Table;
	}


	public function getTableId(){
		return $this->TableId;
	}

	public function getsqlTableId(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->TableId);
		mysqli_close($conn);
		return $value;
	}

	public function setTableId($TableId){
		$this->TableId = $TableId;
	}



	public function getSize(){
		return $this->Size;
	}

	public function getsqlSize(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Size);
		mysqli_close($conn);
		return $value;
	}

	public function setSize($Size){
		$this->Size = $Size;
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



	public function getStatus(){
		return $this->Status;
	}

	public function getsqlStatus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Status);
		mysqli_close($conn);
		return $value;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}


}