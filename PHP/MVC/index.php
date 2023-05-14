<?php
session_start();


require_once('/var/www/html/OnlineChat/PHP/MVC/'.'app/Model.php');
require_once('/var/www/html/OnlineChat/PHP/MVC/'.'app/Controller.php');
require_once("/var/www/html/OnlineChat/PHP/MVC/controllers/Connexions.php");

/*require_once("./app/Model.php");
require_once("./app/Controller.php");
require_once("./app/controllers/Connexions.php");*/


$connexions=new Connexions();
$connexions->Connexion->email=$_POST['email'];
$connexions->Connexion->passwd=$_POST['passwd'];
if(!$connexions->check()){
    header('Location:../../HTML/connexion.php');
  
}
else{
    if(!isset($_SESSION['email'])){
        $_SESSION['email']=$_POST['email'];
    }
    if(!isset($_SESSION['passwd'])){
        $_SESSION['passwd']=$_POST['passwd'];
    }
    header('Location:../../HTML/chat.php');

}


?>