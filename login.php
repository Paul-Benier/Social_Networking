<?php 

// ##### Login form when the user is disconnect #####
if(!isset($_SESSION['LOGGED_USER_fname'])): ?>
    <form action="index.php" method="post">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" aria-describedby="email-help" placeholder="email@example.com">
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        
        <button type="submit" name="login_form" value="Signin">Sign in</button>
    </form>
<?php endif; ?>