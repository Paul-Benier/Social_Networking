<?php

    $takeMessages  = $mysqlClient->query('SELECT * FROM messages');
    while($message = $takeMessages->fetch()){
        //if ($_SESSION['LOGGED_USER_id'] == $message['id_author'] AND $friend_id == $takeMessages['id_receiver']){?>

            <div>
                <h4><?php echo ($message['id_author']);?></h4>
                <p><?php echo ($message['message']);?></p>
                <h6><?php echo ($message['message_date']);?></h6>
            </div><?php

        //}
    }

?>     