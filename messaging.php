<?php 

    if (isset($_SESSION["relationShips"]) && isset($_SESSION["LOGGED_USER_id"])){
        if (!empty($_SESSION["relationShips"])){
            echo '<h2>Private messaging:</h2>';
            echo '<form action="index.php" method="post">';
            foreach ($users as $user) {
                if (in_array($user['user_id'], $_SESSION["relationShips"]) && $user['user_id'] != $_SESSION["LOGGED_USER_id"]){
                    echo '<button type="submit" name="private_messaging_id" value=' . $user['user_id'] . '>' . $user['user_id'] . ' ' . htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . '</button>';
                }
            }
            echo '</form>';
        }
    }

    if (isset($_POST["private_messaging_id"])){
        foreach ($users as $user) {
            if ($user['user_id'] == $_POST["private_messaging_id"]){
                $_SESSION["private_message_user"] = array($user['user_id'], htmlspecialchars($user['first_name']), htmlspecialchars($user['last_name']));
            }
        }
    }
    
    if (isset($_SESSION["private_message_user"])){
        echo "<br><hr><br>Private messaging with " . $_SESSION["private_message_user"][0] . " " . $_SESSION["private_message_user"][1] . " " . $_SESSION["private_message_user"][2];?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <label for="object">Object:</label>
            <input type="text" id="object" name="object" placeholder="The subject of your message...">

            <label for="content">Content</label>
            <textarea name="content" id="content" placeholder="Write your message here..."></textarea>
                
            <label for="screenshot">Insert a file here</label>
            <input type="file" id="screenshot" name="screenshot"/>
                
            <button type="submit" name="private_message" value="send">Send</button>
        </form>
        <?php
        foreach ($users as $user) {
            if ($user['user_id'] == $_SESSION["private_message_user"][0]){
                $fname = htmlspecialchars($user['first_name']);
                $lname = htmlspecialchars($user['last_name']);
            }
        }
        foreach ($privatePosts as $privatePost) {
            if ($privatePost['userfrom_id'] == $_SESSION["private_message_user"][0] && $privatePost['userto_id'] == $_SESSION['LOGGED_USER_id']){
                if ($privatePost['file_name'] == NULL){
                    echo '<div>
                            From ' . $privatePost['userfrom_id'] . ' ' . $fname . ' ' . $lname . ' to ' . $_SESSION['LOGGED_USER_id'] . ' ' . $_SESSION['LOGGED_USER_fname'] . ' send on ' . $privatePost['date'] . 
                            '<h3>' . htmlspecialchars($privatePost['title']) . '</h3>' . 
                            htmlspecialchars($privatePost['content']) . 
                        '</div>';
                }
                else {
                    echo 
                    '<div> 
                        From ' . $privatePost['userfrom_id'] . ' ' . $fname . ' ' . $lname . ' to ' . $_SESSION['LOGGED_USER_id'] . ' ' . $_SESSION['LOGGED_USER_fname'] . ' send on ' . $privatePost['date'] .
                        '<h3>' . htmlspecialchars($privatePost['title']) . '</h3>' .
                        htmlspecialchars($privatePost['content']) . '<br>' .
                        '<img src="uploads/' . $privatePost['file_name'] . '" alt="' . $privatePost['file_name'] . '">' .
                    '</div>';
                }
                echo '<hr>';
                }
            else if ($privatePost['userto_id'] == $_SESSION["private_message_user"][0] && $privatePost['userfrom_id'] == $_SESSION['LOGGED_USER_id']){
                if ($privatePost['file_name'] == NULL){
                    echo '<div style="background-color: navy;">
                    From ' . $_SESSION['LOGGED_USER_id'] . ' ' . $_SESSION['LOGGED_USER_fname'] . ' to ' . $privatePost['userto_id'] . ' ' . $fname . ' ' . $lname . ' send on ' . $privatePost['date'] . 
                            '<h3>' . htmlspecialchars($privatePost['title']) . '</h3>' . 
                            htmlspecialchars($privatePost['content']) . 
                        '</div>';
                }
                else {
                    echo 
                    '<div style="background-color: navy;"> 
                    From ' . $_SESSION['LOGGED_USER_id'] . ' ' . $_SESSION['LOGGED_USER_fname'] . ' to ' . $privatePost['userto_id'] . ' ' . $fname . ' ' . $lname . ' send on ' . $privatePost['date'] . 
                        '<h3>' . htmlspecialchars($privatePost['title']) . '</h3>' .
                        htmlspecialchars($privatePost['content']) . '<br>' .
                        '<img src="uploads/' . $privatePost['file_name'] . '" alt="' . $privatePost['file_name'] . '">' .
                    '</div>';
                }
                echo '<hr>';
            }
            
        }
    } ?>