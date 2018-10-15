<?php
$mdlCandidatePosition = new CandidatePositionModel();
class CandidatePositionModel{
  private $Id = "";
  private $Name = "";
  private $MaxVote = "";
  private $DateCreated = "";

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



public function getMaxVote(){
  return $this->MaxVote;
}

public function getsqlMaxVote(){
  $Database = new Database();
  $conn = $Database->GetConn();
  $value = mysqli_real_escape_string($conn,$this->MaxVote);
  mysqli_close($conn);
  return $value;
}

public function setMaxVote($MaxVote){
  $this->MaxVote = $MaxVote;
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
