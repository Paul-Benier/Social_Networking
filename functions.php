<?php

// ##### Sign up validation #####
if (isset($_POST['login_form'])){
    if ($_POST['login_form'] == "Signup"){
        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_year']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_2'])) {
            if ($_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['birth_year'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['password_2']) {
                if ($_POST['password'] === $_POST['password_2']) {

                    $sqlQuery = 'INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `birth_year`) VALUES (:first_name, :last_name, :email, :password, :birth_year)';
                    $insertUser = $mysqlClient->prepare($sqlQuery);
                    $insertUser->execute([
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'email' => $_POST['email'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'birth_year' => $_POST['birth_year'],
                    ]);

                    $error = 'The account has been created. Now Sign in !!';
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
                    $_SESSION['LOGGED_USER_id'] = $user['user_id'];
                    $_SESSION['LOGGED_USER_fname'] = $user['first_name'];
                    $_SESSION['LOGGED_USER_lname'] = $user['last_name'];
                    $_SESSION['LOGGED_USER_email'] = $user['email'];
                    $_SESSION['LOGGED_USER_byear'] = $user['birth_year'];
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

if(isset($_SESSION['LOGGED_USER_id']) && isset($_POST['id_user'])){
    $sqlQuery = 'INSERT INTO `relationships` (`user_1`, `user_2`, `active`) VALUES (:user_1, :user_2, :active)';
    $insertRelationship = $mysqlClient->prepare($sqlQuery);
    $insertRelationship->execute([
        'user_1' => $_SESSION['LOGGED_USER_id'],
        'user_2' => $_POST['id_user'],
        'active' => '1', // for the moment, by default: 1 (active). After 0 by default and 1 when the user_2 accept
    ]);
    echo "vous êtes maintenant amis avec l'utilisateur " . $_POST['id_user'];
}

?>