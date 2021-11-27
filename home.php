Home page
<?php include("sendmessage.php"); ?>

<?php

foreach ($publicPosts as $publicPost) {
    if ($publicPost['file_name'] == NULL){
        echo '<div>' . $publicPost['user_id'] . ' publish on ' . $publicPost['date'] . 
        '<h3>' . $publicPost['title'] . '</h3>' . $publicPost['content'] . '</div>';
    }
    else {
        echo 
        '<div>' . 
            $publicPost['user_id'] . ' publish on ' . $publicPost['date'] .
            '<h3>' . $publicPost['title'] . '</h3>' .
            $publicPost['content'] . '<br>' .
            '<img src="uploads/' . $publicPost['file_name'] . '" alt="' . $publicPost['file_name'] . '">' .
        '</div>';
    }
    echo '<hr>';
}

?>