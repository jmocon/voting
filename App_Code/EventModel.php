<?php
$mdlEvent = new EventModel();
class EventModel{

	private $Id = "";
	private $Type = "";
	private $StartDateTime = "";
	private $StartTrigger = "";
	private $EndDateTime = "";
	private $EndTrigger = "";
  private $Election_Id = "";
	private $DateCreated = "";

/*
Start | End
	0 		0		- voting not yet started
	1			0		- voting on going
	1			1		- voting ended
	0			1		- unknown

Versus

	0	-	voting not ongoing
	1 - voting ongoing
*/

	public function EventModel(){}

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


	public function getType(){
		return $this->Type;
	}

	public function getsqlType(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Type);
		mysqli_close($conn);
		return $value;
	}

	public function setType($Type){
		$this->Type = $Type;
	}

	public function getStartDateTime(){
		return $this->StartDateTime;
	}

	public function getsqlStartDateTime(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->StartDateTime);
		mysqli_close($conn);
		return $value;
	}

	public function setStartDateTime($StartDateTime){
		$this->StartDateTime = $StartDateTime;
	}


	public function getStartTrigger(){
		return $this->StartTrigger;
	}

	public function getsqlStartTrigger(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->StartTrigger);
		mysqli_close($conn);
		return $value;
	}

	public function setStartTrigger($StartTrigger){
		$this->StartTrigger = $StartTrigger;
	}


	public function getEndDateTime(){
		return $this->EndDateTime;
	}

	public function getsqlEndDateTime(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->EndDateTime);
		mysqli_close($conn);
		return $value;
	}

	public function setEndDateTime($EndDateTime){
		$this->EndDateTime = $EndDateTime;
	}


	public function getEndTrigger(){
		return $this->EndTrigger;
	}

	public function getsqlEndTrigger(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->EndTrigger);
		mysqli_close($conn);
		return $value;
	}

	public function setEndTrigger($EndTrigger){
		$this->EndTrigger = $EndTrigger;
	}


	public function getElection_Id(){
		return $this->Election_Id;
	}

	public function getsqlElection_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Election_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setElection_Id($Election_Id){
		$this->Election_Id = $Election_Id;
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
