<?php
session_start();

if(!isset($_SESSION['email']) || !isset($_SESSION['passwd']) ){
   
?>
<!DOCTYPE = html>
<html lang = fr>
<head>
    <title>ChatRoom</title>
    <meta charset="utf-8" name="viewport" content="width:device-width,initial-scale=1">
    <link rel="stylesheet" href="../CSS/style_connexion.css">
    <link rel="icon" href="../PNG/mini_logonb.png">
</head>
<body class="container">
    <div style="background: radial-gradient( rgb(0, 21, 27), rgb(0,0,0));">
        <canvas id="canvas_connexion">Votre navigateur ne prend pas en charge l'animation</canvas>
        <script src="../script.js"></script>
    </div>
    <div class="item">
        <form method="post" action="../PHP/MVC/index.php">
            <h1 style="font-weight: 900;color:white;margin-left: 30px;">Connectez-vous</h1>
            <input name="email" class="saisie" placeholder="Adresse mail ou téléphone"  requiered><br>
            <div>  
                <input name="passwd" class="saisie" id="password" type="password" placeholder="Mot de passe" requiered>
                <img src="../PNG/eye.svg" id="eye_icone" style="position:absolute;cursor: pointer;translate:-200% 115%;" onclick="afficher_mdp()">
            </div>
            <input class="connexion" type="submit" value="Connexion"><br>
        </form>
        <script>
            e=true;
            function afficher_mdp(){
                if(e){
                    document.getElementById("password").setAttribute("type","text");
                    document.getElementById("eye_icone").src="../PNG/eye-off.svg"
                    e=false;
                }
                else{
                    document.getElementById("password").setAttribute("type","password");
                    document.getElementById("eye_icone").src="../PNG/eye.svg"
                    e=true;
                }
            }
        </script>
        <section><h6 style="color:white;">Toujours pas de compte?</h6><br>
            <a href="inscription.html"><button class="inscription">Créer un compte</button></a>
        </section>
    </div>
</body>
</html>
<?php
}

else{
  
    header('Location:chat.php');
}


?>