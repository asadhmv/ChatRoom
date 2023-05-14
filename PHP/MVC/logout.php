<?php
session_start();
$_SESSION['email']="";
$_SESSION['passwd']="";
session_unset();
session_destroy();
header('Location:../../HTML/connexion.php');


?>