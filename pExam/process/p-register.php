<?php
include "class/Helper.php";
include "class/Database.php";

$msg="";
$email="";
$pName="";


if(isset($_POST['register'])){

 $h=new Helper();
 $email=$_POST['email'];
 $pName=$_POST['profile-name'];

  if($h->isEmpty(array($email,$pName,$_POST['password'],$_POST['confirm-password']))){
   $msg="All Fields are required";
  }

  else if(!$h->isPasswordMatch($_POST['password'],$_POST['confirm-password'])){
   $msg="passwords must match";
  }

  else if(!$h->isValidEmail($email)){
    $msg="Enter a valid email";
  }

  else if($h->isDuplicateEmail($email)){
    $msg="Email is already taken";
  }

  else{
    $h->insertIntoFriendsDB($email,$pName,$_POST['password']);
    header("Location: index.php");
  }
}

?>