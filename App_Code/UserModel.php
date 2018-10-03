<?php
$mdlUser = new UserModel();
class UserModel{

	private $Id = "";
	private $UserType_Id = "";
	private $PrcId = "";
	private $FirstName = "";
	private $MiddleName = "";
	private $LastName = "";
	private $SuffixName = "";
	private $BirthDate = "";
	private $Gender_Id = "";
	private $MobileNumber = "";
	private $TelephoneNumber = "";
	private $HomeAddress = "";
	private $EmailAddress = "";
	private $Facebook = "";
	private $Twitter = "";
	private $GooglePlus = "";
	private $LinkedIn = "";
	private $Username = "";
	private $Password = "";
	private $DateCreated = "";
	private $Status = ""; // 0 - active, 1 - inactive


	public function UserModel(){}

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


	public function getUserType_Id(){
		return $this->UserType_Id;
	}

	public function getsqlUserType_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->UserType_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUserType_Id($UserType_Id){
		$this->UserType_Id = $UserType_Id;
	}

	public function getPrcId(){
		return $this->PrcId;
	}

	public function getsqlPrcId(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->PrcId);
		mysqli_close($conn);
		return $value;
	}

	public function setPrcId($PrcId){
		$this->PrcId = $PrcId;
	}


	public function getFirstName(){
		return $this->FirstName;
	}

	public function getsqlFirstName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->FirstName);
		mysqli_close($conn);
		return $value;
	}

	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;
	}


	public function getMiddleName(){
		return $this->MiddleName;
	}

	public function getsqlMiddleName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->MiddleName);
		mysqli_close($conn);
		return $value;
	}

	public function setMiddleName($MiddleName){
		$this->MiddleName = $MiddleName;
	}


	public function getLastName(){
		return $this->LastName;
	}

	public function getsqlLastName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->LastName);
		mysqli_close($conn);
		return $value;
	}

	public function setLastName($LastName){
		$this->LastName = $LastName;
	}


	public function getSuffixName(){
		return $this->SuffixName;
	}

	public function getsqlSuffixName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->SuffixName);
		mysqli_close($conn);
		return $value;
	}

	public function setSuffixName($SuffixName){
		$this->SuffixName = $SuffixName;
	}


	public function getBirthDate(){
		return $this->BirthDate;
	}

	public function getsqlBirthDate(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->BirthDate);
		mysqli_close($conn);
		return $value;
	}

	public function setBirthDate($BirthDate){
		$this->BirthDate = $BirthDate;
	}


	public function getGender_Id(){
		return $this->Gender_Id;
	}

	public function getsqlGender_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Gender_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setGender_Id($Gender_Id){
		$this->Gender_Id = $Gender_Id;
	}


	public function getMobileNumber(){
		return $this->MobileNumber;
	}

	public function getsqlMobileNumber(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->MobileNumber);
		mysqli_close($conn);
		return $value;
	}

	public function setMobileNumber($MobileNumber){
		$this->MobileNumber = $MobileNumber;
	}


	public function getTelephoneNumber(){
		return $this->TelephoneNumber;
	}

	public function getsqlTelephoneNumber(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->TelephoneNumber);
		mysqli_close($conn);
		return $value;
	}

	public function setTelephoneNumber($TelephoneNumber){
		$this->TelephoneNumber = $TelephoneNumber;
	}


	public function getHomeAddress(){
		return $this->HomeAddress;
	}

	public function getsqlHomeAddress(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->HomeAddress);
		mysqli_close($conn);
		return $value;
	}

	public function setHomeAddress($HomeAddress){
		$this->HomeAddress = $HomeAddress;
	}


	public function getEmailAddress(){
		return $this->EmailAddress;
	}

	public function getsqlEmailAddress(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->EmailAddress);
		mysqli_close($conn);
		return $value;
	}

	public function setEmailAddress($EmailAddress){
		$this->EmailAddress = $EmailAddress;
	}


	public function getFacebook(){
		return $this->Facebook;
	}

	public function getsqlFacebook(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Facebook);
		mysqli_close($conn);
		return $value;
	}

	public function setFacebook($Facebook){
		$this->Facebook = $Facebook;
	}


	public function getTwitter(){
		return $this->Twitter;
	}

	public function getsqlTwitter(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Twitter);
		mysqli_close($conn);
		return $value;
	}

	public function setTwitter($Twitter){
		$this->Twitter = $Twitter;
	}


	public function getGooglePlus(){
		return $this->GooglePlus;
	}

	public function getsqlGooglePlus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->GooglePlus);
		mysqli_close($conn);
		return $value;
	}

	public function setGooglePlus($GooglePlus){
		$this->GooglePlus = $GooglePlus;
	}


	public function getLinkedIn(){
		return $this->LinkedIn;
	}

	public function getsqlLinkedIn(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->LinkedIn);
		mysqli_close($conn);
		return $value;
	}

	public function setLinkedIn($LinkedIn){
		$this->LinkedIn = $LinkedIn;
	}


	public function getUsername(){
		return $this->Username;
	}

	public function getsqlUsername(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Username);
		mysqli_close($conn);
		return $value;
	}

	public function setUsername($Username){
		$this->Username = $Username;
	}


	public function getPassword(){
		return $this->Password;
	}

	public function getsqlPassword(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Password);
		mysqli_close($conn);
		return $value;
	}

	public function setPassword($Password){
		$this->Password = $Password;
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
