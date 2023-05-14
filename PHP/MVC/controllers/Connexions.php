<?php

class Connexions extends Controller{
    public function __construct(){
        $this->loadModel("Connexion");
    }
    
    public function check(){
        return $this->Connexion->check();
    }

    

}


?>