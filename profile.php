<h1>Profile</h1>

<?php if(isset($_SESSION['LOGGED_USER_fname'])): ?>
    <form action="index.php" method="post">

        <label for="id_user">id number: </label>
        <input type="number" id="id_user" name="id_user" placeholder="42">
        
        <button type="submit">Request relationship</button>
    </form>
<?php endif; ?>

<?php

    // echo '<h2>Validate relationships:</h2>';
        
    echo '<h2>List of relationships:</h2>';
    
    for ($i=0 ; $i < count($_SESSION["relationShips"]) ; $i++){
        echo $_SESSION["relationShips"][$i] . '<br>';
    }

?>