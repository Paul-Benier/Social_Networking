<?php 

try{ // ##### database connection #####
$mysqlClient = new PDO(
    'mysql:host=localhost;dbname=social_networking;charset=utf8',
    'root',
    'root'
    );
}
catch(Exception $e){ // ##### error - database connection #####
    die('Error : '.$e->getMessage());
}

// ##### Get the whole user table #####
$sqlQuery = 'SELECT * FROM user';
$usersStatement = $mysqlClient->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// ##### Login validation #####
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_year']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_2'])) {
    if ($_POST['password'] === $_POST['password_2']) {

        $sqlQuery = 'INSERT INTO user(first_name, last_name, birth_year, email, password) VALUES (:first_name, :last_name, :birth_year, :email, :password)';
        $insertRecipe = $mysqlClient->prepare($sqlQuery);
        $insertRecipe->execute([
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'birth_year' => $_POST['birth_year'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        $loggedUser['first_name'] = $_POST['first_name'];
        $errorMessage = 'OK';
    }
    else {
        $errorMessage = 'Please enter correct informations';
    }
}

// ##### Form Sign up #####
if(!isset($loggedUser)){ ?>

<form action="index.php" method="post">
    <!-- ##### Print error if needed ##### -->
    <?php 
    if(isset($errorMessage)) {
        echo $errorMessage;
    } ?>

    <label for="first_name" >First name</label>
    <input type="text" id="first_name" name="first_name" placeholder="John">
    
    <label for="last_name" >Last Name</label>
    <input type="text" id="last_name" name="last_name" placeholder="Smith">

    <label for="birth_year">Birth year</label>
    <input type="number" id="birth_year" name="birth_year" placeholder="1999" min="1900" max="2021" value="1999"> 

    <label for="email" >Email</label>
    <input type="email" id="email" name="email" placeholder="email@example.com">

    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    
    <label for="password_2">Confirm password</label>
    <input type="password" id="password_2" name="password_2">
    
    <button type="submit">Sign up</button>
</form>

<!-- ##### The user is logged in and the account has been created ##### -->
<?php } else { ?>
    <div role="alert">
        <?php echo "The account has been created\n";
        echo $loggedUser['first_name']; ?>
    </div>
<?php } ?>