<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Title of the web page</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>

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
        ?>
        
        <header>  <!-- ##### HEADER ##### -->
            <?php include('header.php'); ?>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            
            <?php 
            if(isset($_POST['login'])){
                if($_POST['login'] == "Signup"){
                    include('signup.php');
                }
                else{
                    include('login.php');
                }
            } ?>

            <form action="index.php" method="post">
                <button type="submit" name="login" value="Signup">Sign up</button> <!-- Create an account -->
                <button type="submit" name="login" value="Signin">Sign in</button> <!-- Login -->
            </form>

        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include('footer.php'); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>

<?php ?>