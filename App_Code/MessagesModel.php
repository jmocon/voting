<?php
$mdlMessages = new MessagesModel();
class MessagesModel{

	private $Id = "";
	private $Property_Id = "";
	private $User_Id = "";
	private $Name = "";
	private $Email = "";
	private $Phone = "";
	private $Subject = "";
	private $Message = "";
	private $Read = "";
	private $DateCreated = "";
	private $Status = "";


	public function MessagesModel(){}

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
	


	public function getProperty_Id(){
		return $this->Property_Id;
	}
	
	public function getsqlProperty_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Property_Id);
		mysqli_close($conn);
		return $value;
	}
	
	public function setProperty_Id($Property_Id){
		$this->Property_Id = $Property_Id;
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
	


	public function getEmail(){
		return $this->Email;
	}
	
	public function getsqlEmail(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Email);
		mysqli_close($conn);
		return $value;
	}
	
	public function setEmail($Email){
		$this->Email = $Email;
	}
	


	public function getPhone(){
		return $this->Phone;
	}
	
	public function getsqlPhone(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Phone);
		mysqli_close($conn);
		return $value;
	}
	
	public function setPhone($Phone){
		$this->Phone = $Phone;
	}
	


	public function getSubject(){
		return $this->Subject;
	}
	
	public function getsqlSubject(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Subject);
		mysqli_close($conn);
		return $value;
	}
	
	public function setSubject($Subject){
		$this->Subject = $Subject;
	}
	


	public function getMessage(){
		return $this->Message;
	}
	
	public function getsqlMessage(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Message);
		mysqli_close($conn);
		return $value;
	}
	
	public function setMessage($Message){
		$this->Message = $Message;
	}
	


	public function getRead(){
		return $this->Read;
	}
	
	public function getsqlRead(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Read);
		mysqli_close($conn);
		return $value;
	}
	
	public function setRead($Read){
		$this->Read = $Read;
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