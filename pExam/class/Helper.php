<?php
// include "class/Database.php";

class Helper{

    // protected $d;

    public function isEmpty($postValues){
        
        foreach ($postValues as $value){
            if ($value == '')
                return true;
        }
        
        return false;
        
    }

    function isPasswordMatch($p1,$p2){
        if($p1==$p2){
            return true;
        }
        return false;
    }

    function isValidEmail($email){
        if((preg_match( 
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) ){
                return true;
            }

            return false;
    }


    function isDuplicateEmail($email){

        $sql="SELECT count(friend_email) as num FROM friends WHERE friend_email=:email";

        $values=array(
            array(':email',$email));

        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);

        if($result['num']==0){
            return false;
        }

        return true;
    }

    function insertIntoFriendsDB($email,$pName,$password){
        $sql="INSERT INTO friends (friend_email,password,profile_name,date_starded)VALUES(:email,:password,:pName,:dStart)";

        $values=array(
            array(':email',$email),
            array(':password',$password),
            array(':pName',$pName),
            array(':dStart',$currentDate = date('Y-m-d'))
        );

        $d=new Database();

        $result=$d->queryDB($sql,Database::EXECUTE, $values);
    }

// ------------------------login functions-----------------------------------------------
    function isEmailExist($email){
        $sql="SELECT count(friend_email) as num FROM friends WHERE friend_email=:email";

        $values=array(
            array(':email',$email));

        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);

        if($result['num']==0){
            return false;
        }

        return true;
    }

    function isPasswordCorrect($p,$email){
        $sql="SELECT password FROM friends WHERE friend_email=:email";

        $values=array(
            array(':email',$email));

        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);

        if($p==$result['password']){
            return true;
        }

        else false;
    }

    // ---------------------------------------AddFriendsPageFunctions----------------------

    function getUserFromDB($email){
        $sql="SELECT * FROM friends WHERE friend_email=:email";

        $values=array(
            array(':email',$email));

        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);
        return $result;


    }

    function getFriendsIDFromDB($friend_id){
        $sql="SELECT * FROM myfrinds WHERE friend_id1=:friend_id";

        $values=array(
            array(':friend_id',$friend_id));

        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTALL, $values);
        return $result;

    }

    function getFriendsNameFromDB($friend_id){
        $sql="SELECT * FROM friends WHERE friend_id=:friend_id";

            $values=array(
                array(':friend_id',$friend_id));
        
        $d=new Database();

        $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);
        return $result;


    }

    function getAllMembers($userMail){
        $sql="SELECT * FROM friends WHERE friend_email!=:userMail"
;
        $values=array(
            array(':userMail',$userMail));
    
    $d=new Database();

    $result=$d->queryDB($sql,Database::SELECTALL, $values);
    return $result; 
    }

    function unFriend($user_id,$friend_id){
        $sql="DELETE FROM myfrinds WHERE friend_id1=:id1 AND friend_id2=:id2";
        $values=array(
            array(':id1',$user_id),
            array(':id2',$friend_id)
        );
    $d=new Database();

    $d->queryDB($sql,Database::EXECUTE, $values);
     
    }

    function addFriend($user_id,$friend_id){
        $sql="INSERT INTO myfrinds VALUES(:id1,:id2)";
        $values=array(
            array(':id1',$user_id),
            array(':id2',$friend_id)
        );
    $d=new Database();

    $d->queryDB($sql,Database::EXECUTE, $values);
     
    }

    function avoidDuplicateEntry($user_id,$friend_id){
        $sql="SELECT COUNT(*) AS num FROM myfrinds WHERE friend_id1=:id1 AND friend_id2=:id2";
        $values=array(
            array(':id1',$user_id),
            array(':id2',$friend_id)
        );
    $d=new Database();

    $result=$d->queryDB($sql,Database::SELECTSINGLE, $values);

    if($result['num']==0){
        return $this->addFriend($user_id,$friend_id);
    }
    }
        

}
?>