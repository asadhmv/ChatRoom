<?php
session_start();
$_SESSION['email']="";
$_SESSION['passwd']="";
session_unset();
session_destroy();

require_once('/var/www/html/INSACHAT/PHP/MVC/'.'app/Model.php');
require_once('/var/www/html/INSACHAT/PHP/MVC/'.'app/Controller.php');
require_once("/var/www/html/INSACHAT/PHP/MVC/controllers/Connexions.php");

$connexions=new Connexions();
$connexions->Connexion->email=$_POST['email'];
$connexions->Connexion->passwd=$_POST['passwd'];
$connexions->Connexion->nom=$_POST['nom'];
$connexions->Connexion->prenom=$_POST['prenom'];
$connexions->Connexion->journaissance=$_POST['journaissance'];
$connexions->Connexion->moisdenaissance=$_POST['moisdenaissance'];
$connexions->Connexion->anneedenaissance=$_POST['anneedenaissance'];
$connexions->Connexion->titredecivilite=$_POST['titredecivilite'];
$connexions->Connexion->adduser();
header('Location:../../HTML/connexion.php');


?>