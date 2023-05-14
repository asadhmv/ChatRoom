<?php

require_once("/var/www/html/OnlineChat/PHP/MVC/app/Model.php");
class Chatting extends Model{
    public function __construct(){
        $this->table="general_chat";
        $this->getConnection();
    }

    public function sendMessage($sender, $message){
        if(strlen($message)>0){
            $date_array = getdate();
            $date = $date_array['weekday'] . " " . $date_array['mday'] . " " . $date_array['month'] . " " . $date_array['year'];
            $time = $date_array['hours'] . ":" . $date_array['minutes'];
            
            $sql="INSERT INTO general_chat (sender, date, time, message) VALUES ('".$sender."','".$date."','".$time."','".$message."')";
            $query=$this->_connexion->prepare($sql);
            $query->execute();
        }
    }

    public function LoadMessages(){
        $sql = "SELECT * FROM " . $this->table;
        $load_messages = $this->_connexion->query($sql);
        /*while($message = $load_messages->fetch()){
            ?>
            <div class="msg">
                <h1><?php echo $message['sender']; ?></h1>
                <p><?php echo $message['message']; ?></p>
            </div>
            <?php
        }*/
        //print_r($load_messages->fetchAll());
        return $load_messages->fetchAll(PDO::FETCH_ASSOC);
    }
}