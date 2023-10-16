<?php
class exercise{
    private $pdo;

    const SELECTSINGLE=1;
    const SELECTALL=2;
    const EXECUTE=3;

    public function __construct(){
        $this->pdo=new PDO("mysql:host=localhost;dbname=seng21253","baba","2000");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    PUBLIC function queryDB($sql,$mode,$values=array()){
        $stmt=$this->pdo->prepare($sql);

        foreach($values as $valueToBind){
            $stmt->bindValue($valueToBind[0],$valueToBind[1]);
        }

        $stmt->execute();

        if($mode==exercise::SELECTSINGLE){
           return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        else if($mode==exercise::SELECTALL){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }


}
?>