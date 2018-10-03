<?php
$mdlContent = new ContentModel();
class ContentModel{

	private $Id = "";
	private $Name = "";
	private $Value = "";


	public function ContentModel(){}

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


	public function getValue(){
		return $this->Value;
	}

	public function getsqlValue(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Value);
		mysqli_close($conn);
		return $value;
	}

	public function setValue($Value){
		$this->Value = $Value;
	}


}