<?php
    session_start();
    
    if(!isset($_POST['send'])){
        header("Location: messaging.php");
    }
    
    if(isset($friend_id) && !empty($_GET['id'])){
        $takeUser = $mysqlClient->prepare("SELECT * FROM user WHERE user_id = ?");
        $takeUser->execute(array($_GET['id']));
        if($takeUser->rowCount() > 0){
            if(isset($_POST['send'])){
                $message= htmlspecialchars($_POST['message']);
                $send_date = date('y-m-d h:i:s');
                $insertMessage = $mysqlClient->prepare('INSERT INTO messages(message, id_receiver, id_author, message_date) VALUES(?, ?, ?, ?)');
                $insertMessage->execute(array($message, $_GET['id'], $_SESSION['LOGGED_USER_id'], $send_date));
            }
        }
        else{
            echo "User's friend not found.";
        }
    }else{
        echo "User not found";
    }
    
?>     

 <!DOCTYPE html>
 <html>
<head>
    <title>
        ChatBox
    </title>
    <meta charset="utf-8">
</head>
<body>
    <header>Chatbox</header>
   
    <form method= "POST" action=''>
        <textarea name="message"></textarea>
        <br/><br/>
        <input type="submit" name="send"></input>
    </form>
    
    <section id="messages">
        <?php
            $takeMessages  = $mysqlClient->prepare('SELECT * FROM messages WHERE id_author = ? AND id_receiver = ? OR id_author = ? AND id_receiver = ?');
            $takeMessages->execute(array($_SESSION['LOGGED_USER_id'], $_GET['id'], $_GET['id'], $_SESSION['LOGGED_USER_id']));
            while($message = $takeMessages->fetch()){
                if ($message['id_receiver'] == $_SESSION['LOGGED_USER_id']){
                    ?>
                    <p style = "color:red;"><?= $message['message']; ?></p>
                    <?php
                }elseif ($message['id_receiver'] == $_GET['id']){
                    ?>
                    <p style = "colors:green;"><?= $message['message']; ?></p>
                    <?php
                }
            }
        ?>
    </section>
</body>
 </html>