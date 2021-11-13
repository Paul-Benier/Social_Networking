<?php 

/*try{ // ##### database connection #####
$mysqlClient = new PDO(
    'mysql:host=localhost;dbname=social_networking;charset=utf8',
    'root',
    'root'
    );
}
catch(Exception $e){ // ##### error - database connection #####
    die('Error : '.$e->getMessage());
}*/

// ##### Get the whole user table #####
$sqlQuery = 'SELECT * FROM user';
$usersStatement = $mysqlClient->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// ##### Login form when the user is disconnect #####
if(!isset($loggedUser)): ?>
<form action="index.php" method="post">
    
    <!-- ##### Print error if needed ##### -->
    <?php if(isset($errorMessage)) : ?>
        <div role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" aria-describedby="email-help" placeholder="email@example.com">
    
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    
    <button type="submit">Sign in</button>
</form>
<?php endif; ?>