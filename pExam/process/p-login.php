<?php
include "class/Helper.php";
include "class/Database.php";

$email="";
$msg="";

if(isset($_POST['login'])){
 
    $h=new Helper();
    $email=$_POST['email'];

    if($h->isEmpty(array($email,$_POST['password']))){
        $msg="All Fields are required";
    }

    else if(!$h->isEmailExist($email)){
        $msg="Register for an account";
    }

    else if(!$h->isPasswordCorrect($_POST['password'],$email)){
        $msg="Enter correct password";
    }

    else{
        $_SESSION['email']=$email;

        header("Location:addFriendsPage");
    }
}
?>