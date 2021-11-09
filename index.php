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
            <?php include('login.php'); ?>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            This is the main page
        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include('footer.php'); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>

<?php ?>