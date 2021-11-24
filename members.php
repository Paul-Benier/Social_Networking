<h1>List of members:</h1>

<?php

foreach ($users as $user) {
    echo /*$user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . ' ' .*/ 
    '<form action="index.php" method="post">
        <button action="index.php" method="post" type="submit" name="id_user" value=' . $user['user_id'] . '>add ' . $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . '</button>
    </form>' . '<br>';
}

?>