<?php 

try{ // ##### database connection #####
$mysqlClient = new PDO(
    'mysql:host=localhost;dbname=social_networking;charset=utf8',
    'root',
    'root'
    );
}
catch(Exception $e){ // ##### error - database connection #####
    die('Erreur : '.$e->getMessage());
}

// ##### Get the whole user table #####
$sqlQuery = 'SELECT * FROM user';
$usersStatement = $mysqlClient->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// ##### Login validation #####
if (isset($_POST['email']) &&  isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            $loggedUser = $user;
        } else {
            $errorMessage = 'Incorrect email or password';
        }
    }
}

// ##### Login form when the user is disconnect #####
if(!isset($loggedUser)): ?>
<form action="index.php" method="post">
    
    <!-- ##### Print error if needed ##### -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="email@example.com">
    
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>

<!-- ##### The user is logged in ##### -->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        <?php echo $loggedUser['first_name']; ?>
    </div>
<?php endif; ?>