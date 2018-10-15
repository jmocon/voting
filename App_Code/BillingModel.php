<?php
$mdlBilling = new BillingModel();
class BillingModel{
  private $Id = "";
  private $Name = "";
  private $Description = "";
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



public function getDescription(){
  return $this->Description;
}

public function getsqlDescription(){
  $Database = new Database();
  $conn = $Database->GetConn();
  $value = mysqli_real_escape_string($conn,$this->Description);
  mysqli_close($conn);
  return $value;
}

public function setDescription($Description){
  $this->Description = $Description;
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
