<h1>Profile</h1>

<?php
    if (isset($_SESSION["relationShipsTBC"]) && isset($_SESSION["LOGGED_USER_id"])){
        if (!empty($_SESSION["relationShipsTBC"])){
            echo '<h2>Validate relationships:</h2>';
            foreach ($users as $user) {
                if (in_array($user['user_id'], $_SESSION["relationShipsTBC"]) && $user['user_id'] != $_SESSION["LOGGED_USER_id"]){
                    echo '<form action="index.php" method="post">
                        <label for="id_user">' . $user['user_id'] . ' ' . htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . '</label>
                        <button type="submit" name="validate_request" value=' . $user['user_id'] . '>Accept</button>
                        </form>';
                }
            }
        }
    }

    if (isset($_SESSION["relationShipsHold"]) && isset($_SESSION["LOGGED_USER_id"])){
        if (!empty($_SESSION["relationShipsHold"])){
            echo "<h2>friend request on hold:</h2>";
            foreach ($users as $user) {
                if (in_array($user['user_id'], $_SESSION["relationShipsHold"]) && $user['user_id'] != $_SESSION["LOGGED_USER_id"]){
                    echo $user['user_id'] . ' ' . htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . '<br>';
                }
            }
        }
    }
        
    if (isset($_SESSION["relationShips"]) && isset($_SESSION["LOGGED_USER_id"])){
        if (!empty($_SESSION["relationShips"])){
            echo '<h2>List of relationships:</h2>';
            foreach ($users as $user) {
                if (in_array($user['user_id'], $_SESSION["relationShips"]) && $user['user_id'] != $_SESSION["LOGGED_USER_id"]){
                    echo $user['user_id'] . ' ' . htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) . '<br>';
                }
            }
        }
    }

?>