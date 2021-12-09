<?php 

session_start(); 

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


// ##### Get the whole relationships table #####
$sqlQuery = 'SELECT * FROM relationships';
$relationshipsStatement = $mysqlClient->prepare($sqlQuery);
$relationshipsStatement->execute();
$relationships = $relationshipsStatement->fetchAll();


// ##### Get the whole public_post table #####
$sqlQuery = 'SELECT * FROM public_post ORDER BY `date` DESC';
$publicPostsStatement = $mysqlClient->prepare($sqlQuery);
$publicPostsStatement->execute();
$publicPosts = $publicPostsStatement->fetchAll();

// ##### Get the whole public_post table #####
$sqlQuery = 'SELECT * FROM private_post ORDER BY `date` DESC';
$privatePostsStatement = $mysqlClient->prepare($sqlQuery);
$privatePostsStatement->execute();
$privatePosts = $privatePostsStatement->fetchAll();


include('functions.php');


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Title of the web page</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <!-- Responsive design -->
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        
        <header>  <!-- ##### HEADER ##### -->
            <?php 
            include('header.php'); 
            if(isset($_SESSION['LOGGED_USER'][0])){
                echo $_SESSION['LOGGED_USER'][1] . " " . $_SESSION['LOGGED_USER'][2];
            }
            ?>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            <?php
            if(isset($_POST['login'])){
                if($_POST['login'] == "Signup"){
                    include('signup.php');
                }
                else if ($_POST['login'] == "Disconnect"){
                    session_destroy();
                    header("Refresh:0"); // Refresh the page to actualise the disconnection
                }
                else if ($_POST['login'] == "Signin"){
                    include('login.php');
                }
            }
            else if (isset($_SESSION["return_page"])){
                if ($_SESSION["return_page"] == "Signup"){
                    include('signup.php');
                }
                else if ($_SESSION["return_page"] == "Signin"){
                    include('login.php');
                }
            }
            ?>     

            <form action="index.php" method="post">
                <?php if (!isset($_SESSION['LOGGED_USER'][0])) : ?>
                    <?php if (isset($_POST['login'])) : ?>
                        <?php if ($_POST['login'] != "Signup") : ?>
                            <button type="submit" name="login" value="Signup">Sign up</button> <!-- Create an account -->
                        <?php elseif ($_POST['login'] != "Signin") : ?>
                            <button type="submit" name="login" value="Signin">Sign in</button> <!-- Login -->
                        <?php endif ?>
                    <?php else : ?>
                        <button type="submit" name="login" value="Signup">Sign up</button> <!-- Create an account -->
                        <button type="submit" name="login" value="Signin">Sign in</button> <!-- Login -->
                    <?php endif ?>
                <?php else : ?>
                    <button type="submit" name="login" value="Disconnect">Disconnect</button> <!-- Disconnect -->
                <?php endif ?>
            </form>

            <?php 
            
            if (isset($_SESSION["return_page"])){
                if (isset($_SESSION['LOGGED_USER'][0])){
                    if ($_SESSION["return_page"] == "Profile"){
                        $_SESSION["refresh_friend_array"] = 1;
                        $_SESSION["refresh_friend_array_TBC"] = 1;
                        $_SESSION["refresh_friend_array_Hold"] = 1;
                        include('profile.php');
                    }
                    else if ($_SESSION["return_page"] == "Messaging"){
                        include('messaging.php');
                    }
                    else if ($_SESSION["return_page"] == "Members"){
                        $_SESSION["refresh_friend_array"] = 1;
                        $_SESSION["refresh_friend_array_TBC"] = 1;
                        $_SESSION["refresh_friend_array_Hold"] = 1;
                        include('members.php');
                    }
                    else if ($_SESSION["return_page"] == "Home"){
                        include('home.php');
                    }
                }
                else{
                    echo 'To access the site, you must log in';
                }
            }
            ?>

        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include('footer.php'); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>