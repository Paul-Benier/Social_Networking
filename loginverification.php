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

// ##### Sign up validation #####
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_year']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_2'])) {
    if ($_POST['password'] === $_POST['password_2']) {

        $sqlQuery = 'INSERT INTO user(first_name, last_name, birth_year, email, password) VALUES (:first_name, :last_name, :birth_year, :email, :password)';
        $insertRecipe = $mysqlClient->prepare($sqlQuery);
        $insertRecipe->execute([
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'birth_year' => $_POST['birth_year'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ]);

        $loggedUser['first_name'] = $_POST['first_name'];
        echo "\nThe account has been created\n";
    }
    else {
        $errorMessage = 'Please enter correct informations';
    }
}

// ##### Login validation #####
else if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            password_verify($_POST['password'], $user['password'])
        ) {
            $loggedUser = $user;
            $_SESSION['LOGGED_USER'] = $loggedUser['first_name'];
        } 
        else {
            $errorMessage = 'Incorrect email or password';
        } 
    }
}
?>