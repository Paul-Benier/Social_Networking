<h1>Profile</h1>

<?php if(isset($_SESSION['LOGGED_USER_fname'])): ?>
    <form action="index.php" method="post">

        <label for="id_user">id number: </label>
        <input type="number" id="id_user" name="id_user" placeholder="42">
        
        <button type="submit">Request relationship</button>
    </form>
<?php endif; ?>

<?php

    /*echo '<h2>Validate relationships:</h2>';
        
    $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_1`=1 AND `active`=0 OR `user_2`=1 AND `active`=0';
    $searchRelationship = $mysqlClient->prepare($sqlQuery);
    $searchRelationship->execute();
    $relationships = $searchRelationship->fetchAll();

    foreach ($relationships as $relationship) {
        if ($relationship['user_2'] == 1){
            echo $relationship['user_1'] . $user['first_name'] . '<br>';
        }
        else if ($relationship['user_1'] == 1){
            echo $relationship['user_2'] . '<br>';
        }
    }*/

    echo '<h2>List of relationships:</h2>';

    $id_user = $_SESSION["LOGGED_USER_id"];
    $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_1`= 1 AND `active`= 1 OR `user_2`= 1 AND `active`= 1'; // Change 1 to user_1 and user_2
    $searchRelationship = $mysqlClient->prepare($sqlQuery);
    $searchRelationship->execute();
    $relationships = $searchRelationship->fetchAll();

    foreach ($relationships as $relationship) {
        if ($relationship['user_2'] == 1){
            echo $relationship['user_1'] . $user['first_name'] . '<br>';
        }
        else if ($relationship['user_1'] == 1){
            echo $relationship['user_2'] . '<br>';
        }
    }

/*foreach ($users as $user) {
    echo $user['first_name'] . ' ' . $user['last_name'] . '<br>';
}*/

?>