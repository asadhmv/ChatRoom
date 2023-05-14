<?php

class Connexion extends Model{
    public $email;
    public $passwd;
    public $nom;
    public $prenom;
    public $journaissance;
    public $moisdenaissance;
    public $anneedenaissance;
    public $titredecivilite;
    public function __construct(){
        $this->table="coinsa";
        $this->getConnection();
    }
    public function findByMail(){
        $sql="SELECT * FROM ".$this->table." WHERE email='".$this->email."'";
        $query=$this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function check(){
        $table=$this->findByMail();
        if($table['email']==$this->email && $table['passwd']==$this->passwd){
            return true;
        }
        return false;

    }
    public function adduser(){
       
        $sql="INSERT INTO coinsa (email,passwd,nom,prenom,journaissance,moisdenaissance,anneedenaissance,titredecivilite) VALUES ('".$this->email."','".$this->passwd."','".$this->nom."','".$this->prenom."','".$this->journaissance."','".$this->moisdenaissance."','".$this->anneedenaissance."','".$this->titredecivilite."')";
        $query=$this->_connexion->prepare($sql);
        $query->execute();
    }

}


?>