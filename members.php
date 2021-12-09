<h1>List of members:</h1>

<?php

if (isset($_SESSION["relationShips"]) && isset($_SESSION["LOGGED_USER_id"])){
    foreach ($users as $user) {
        if (in_array($user['user_id'], $_SESSION["relationShips"]) || $user['user_id'] == $_SESSION["LOGGED_USER_id"]){
            echo '<label for="id_user">' . $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . '</label><br><br>';
        }
        else if (in_array($user['user_id'], $_SESSION["relationShipsHold"])){
            echo '<label for="id_user">' . $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . ': friend request on hold</label><br><br>';
        }
        else if (in_array($user['user_id'], $_SESSION["relationShipsTBC"])){
            echo '<form action="index.php" method="post">
                    <label for="id_user">' . $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . '</label>
                    <button type="submit" name="validate_request" value=' . $user['user_id'] . '>Accept</button>
                </form><br>';
        }
        else {
            echo '<form action="index.php" method="post">
                    <label for="id_user">' . $user['user_id'] . ' ' . $user['first_name'] . ' ' . $user['last_name'] . '</label>
                    <button type="submit" name="id_user" value=' . $user['user_id'] . '>add</button>
                </form><br>';
        }
    }
}

?>