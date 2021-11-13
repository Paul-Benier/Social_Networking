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

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Title of the web page</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        
        <header>  <!-- ##### HEADER ##### -->
            <?php 
            include('header.php'); 
            if(isset($_SESSION['LOGGED_USER'])){
                echo $_SESSION['LOGGED_USER'];
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
                }
                else if ($_POST['login'] == "Signin"){
                    include('login.php');
                }
            }
            include('loginverification.php');
            ?>

            <form action="index.php" method="post">
                <button type="submit" name="login" value="Signup">Sign up</button> <!-- Create an account -->
                <button type="submit" name="login" value="Signin">Sign in</button> <!-- Login -->
                <button type="submit" name="login" value="Disconnect">Disconnect</button> <!-- Disconnect -->
            </form>

            <?php 
            if(isset($_POST['menu'])){
                if($_POST['menu'] == "Members"){
                    include('members.php');
                }
                else if($_POST['menu'] == "Messaging"){
                    include('messaging.php');
                }
                else if($_POST['menu'] == "Myprofile"){
                    include('profile.php');
                }
                else{
                    include('home.php');
                }
            }
            ?>

        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include('footer.php'); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>

<?php ?>