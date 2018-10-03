<?php
$clsFn = new Functions();
class Functions{

  	public function Functions(){}

  	public function setForm($name, &$mdl, $required=false){
  		$msg = "";

  		if(isset($_POST[$name]) && $_POST[$name] != ""){
  			$mdl->{'set'.$name}($_POST[$name]);
  		}else{
  			if($required){
  				$msg .= "<p>";
  				$msg .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"input".$name."\")'>".$name."</a> missing.";
  				$msg .= "</p>";
  			}
  		}

  		return $msg;
  	}
}
