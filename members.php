<h1>List of members:</h1>

<?php

foreach ($users as $user) {
    echo $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . ' ' . '<button type="submit">add</button>' . '<br>';
}

?>