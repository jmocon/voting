<?php
$mdlVote = new VoteModel();
class VoteModel{

	private $Id = "";
	private $User_Id = "";
  private $Election_Id = "";
  private $Candidate_Id = "";


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

  public function getCandidate_Id(){
		return $this->Candidate_Id;
	}

	public function getsqlCandidate_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Candidate_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setCandidate_Id($Candidate_Id){
		$this->Candidate_Id = $Candidate_Id;
	}
}
