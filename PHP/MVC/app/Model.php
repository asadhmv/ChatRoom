<?php
 abstract class Model{
    private $host="localhost";
    //private $dbname="insa_chat";
    private $dbname="chatroom";

    private $username="root";
    private $password="root";
    protected $_connexion;
    public $table;
    
    public function getConnection(){
        $this->_connexion=null;
        try{
            $this->_connexion=new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username,$this->password);
        }
        catch(PDOException $exception){
            echo "PDO : ".$exception->getMessage();
        }
    }
    public function getAll(){
        $sql="SELECT * FROM ".$this->table;
        $query=$this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
   
}



?>