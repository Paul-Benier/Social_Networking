<?php if (isset($_SESSION['LOGGED_USER_fname'])){?>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="object">Object:</label>
        <input type="text" id="object" name="object" placeholder="The subject of your message...">

        <label for="content">Content</label>
        <textarea name="content" id="content" placeholder="Write your message here..."></textarea>
            
        <label for="screenshot">Insert a file here</label>
        <input type="file" id="screenshot" name="screenshot"/>
            
        <button type="submit" name="publicSend" value="send">Send</button>
    </form>

    <?php

    foreach ($publicPosts as $publicPost) {
        foreach ($users as $user) {
            if ($user['user_id'] == $publicPost['user_id']){
                $fname = htmlspecialchars($user['first_name']);
                $lname = htmlspecialchars($user['last_name']);
            }
        }
        if ($publicPost['file_name'] == NULL){
            echo '<div>' . $publicPost['user_id'] . ' ' . $fname . ' ' . $lname . ' publish on ' . $publicPost['date'] . 
            '<h3>' . htmlspecialchars($publicPost['title']) . '</h3>' . htmlspecialchars($publicPost['content']) . '</div>';
        }
        else {
            echo 
            '<div>' . 
                $publicPost['user_id'] . ' publish on ' . $publicPost['date'] .
                '<h3>' . htmlspecialchars($publicPost['title']) . '</h3>' .
                htmlspecialchars($publicPost['content']) . '<br>' .
                '<img src="uploads/' . $publicPost['file_name'] . '" alt="' . $publicPost['file_name'] . '">' .
            '</div>';
        }
        echo '<hr>';
    }
}
?>