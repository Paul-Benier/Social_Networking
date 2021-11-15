<?php 

// ##### Form Sign up #####
if(!isset($_SESSION['LOGGED_USER_fname'])){ ?>

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

<?php } ?>