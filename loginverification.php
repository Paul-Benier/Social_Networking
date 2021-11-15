<?php

// ##### Sign up validation #####
if (isset($_POST['login_form'])){
    if ($_POST['login_form'] == "Signup"){
        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_year']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_2'])) {
            if ($_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['birth_year'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['password_2']) {
                if ($_POST['password'] === $_POST['password_2']) {

                    $sqlQuery = 'INSERT INTO user(first_name, last_name, email, password, birth_year, relationships) VALUES (:first_name, :last_name, :email, :password, :birth_year, :relationships)';
                    $insertRecipe = $mysqlClient->prepare($sqlQuery);
                    $insertRecipe->execute([
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'email' => $_POST['email'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'birth_year' => $_POST['birth_year'],
                        'relationships' => 0,
                    ]);

                    $_SESSION['LOGGED_USER_fname'] = $_POST['first_name'];
                    $_SESSION['LOGGED_USER_lname'] = $_POST['last_name'];
                    $_SESSION['LOGGED_USER_byear'] = $_POST['birth_year'];
                    $_SESSION['LOGGED_USER_email'] = $_POST['email'];
                    $error = 'The account has been created';
                }
                else {
                    $error = 'Wrong password';
                }
            }
            else {
                $error = 'Please enter all informations';
            }
        }
        else {
            $error = 'Please enter correct informations';
        }
    }

    // ##### Login validation #####
    if ($_POST['login_form'] == "Signin"){
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $errorvalidation = TRUE;
            foreach ($users as $user) {
                if ($user['email'] === $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['LOGGED_USER_fname'] = $user['first_name'];
                    $_SESSION['LOGGED_USER_lname'] = $user['last_name'];
                    $_SESSION['LOGGED_USER_byear'] = $user['birth_year'];
                    $_SESSION['LOGGED_USER_email'] = $user['email'];
                    $errorvalidation = FALSE;
                }
            }
            if ($errorvalidation){
                $error = 'Incorrect email or password';
            }
        }
        else{
            $error = 'Please enter correct informations';
        }
    }
}

if(isset($error)){
    echo $error;
}

?>