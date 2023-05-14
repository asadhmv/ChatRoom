<?php
session_start();

require_once("/var/www/html/INSACHAT/PHP/MVC/models/Chatting.php");
$chat = new Chatting();
$_SESSION['msg']="";
if(!isset($_SESSION['email']) || !isset($_SESSION['passwd']) ){
    header('Location:connexion.php');
}
else{
    if(isset($_POST['SendMessage']) && isset($_POST['message'])){
        if($_SESSION['msg']!=$_POST['message']){
            $chat->sendMessage($_SESSION['email'], $_POST['message']);
    }
        $_SESSION['msg']=$_POST['message'];
    }
?>
<!DOCTYPE = html>
<html lang = fr>
<head>
    <title>ChatRoom</title>
    <meta charset="utf-8" name="viewport" content="width:device-width,initial-scale=1">
    <link rel="stylesheet" href="../CSS/style_chat.css">
    <link rel="icon" href="../PNG/mini_logonb.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body class="container">
    
    <section class="liste_amis">
        <nav>
            <ul>
                <li>Ami 1</li>
                <li>Ami 2</li>
                <li>Ami 3</li>
            </ul>
        </nav>
        <a href="../PHP/MVC/logout.php"><button class="logout">Déconnexion</button></a>
    </section>

    <section class="discussion"></section>

    <form class="chat" method="POST">
        <input class="send_msg" id="enter" name="message" placeholder="Message...">
        <input type="submit" id="send" value="Envoyer" name="SendMessage">
    </form>
    
    <script>
        const elmnt=document.getElementById('send');
        elmnt.addEventListener('click',change);
        function change(){
            setTimeout(500,function(){});
            document.getElementById('enter').innerHTML="";
        }
        setInterval(load_messages, 500);
        
        function load_messages(){
            <?php
            $requete = $chat->LoadMessages();
            $json = json_encode($requete);
            $user = json_encode($_SESSION['email']);
            ?>
            var username = JSON.parse('<?php echo $user; ?>')
            var jsArray = JSON.parse('<?php echo $json; ?>');
            document.getElementsByClassName('discussion')[0].innerHTML = "";
           
            for(let i=0; i<jsArray.length ; i++)
            {   if(jsArray[i]['message'].length != 0){
                    maDiv = document.createElement("div");
                    if(jsArray[i]['sender'] == username){
                        maDiv.id = 'my_message';
                    }
                    else{
                        maDiv.id = 'others_message';
                    }
                    maDiv.innerHTML = jsArray[i]['sender']; //Peut contenir de l'html
                    maDiv.innerHTML += '<br>' + jsArray[i]['message'] +'<br>'+'<br>';
                    $(maDiv).appendTo('.discussion');
                }
                //document.getElementsByClassName('discussion').append(maDiv);
                /*document.getElementsByClassName('discussion')[0].innerHTML+= jsArray[i]['sender'];
                document.getElementsByClassName('discussion')[0].innerHTML+= jsArray[i]['date'];
                document.getElementsByClassName('discussion')[0].innerHTML+= jsArray[i]['time'];
                document.getElementsByClassName('discussion')[0].innerHTML+= jsArray[i]['message'];*/
                /*var message= {
                sender: jsArray[i]['sender'],
                date: jsArray[i]['date'],
                time: jsArray[i]['time'],
                message: jsArray[i]['message']
                };
                var template = '<div class="message"><h1>$message[sender]</h1><p>${message.message}</p></div>';
                $(document).ready(function() {
                $(template).appendTo('.discussion');
                });*/
            }
        }
    </script>
</body>
</html>
<?php
}
$_POST['message'] = "";
?>