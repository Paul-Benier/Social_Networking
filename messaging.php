<script>
    setFriend_id(id);{
        var php_id =id;
        <?php $friend_id = "<script>id</script>";?>
    }

</script>

<?php $takeUser = $mysqlClient->query('SELECT * FROM user');?>
<?php $friendList = $mysqlClient->query('SELECT * FROM relationships');?>

<table><?php
    while ($friend = $friendList->fetch()) {
        if ($_SESSION['LOGGED_USER_id'] == $friend['user_1']) {
            while ($user = $takeUser->fetch()) {
                if ($friend['user_2'] == $user['user_id'] and $friend['active']==1) {?>

                    <tr><td>
                        <input type="button" onclick="setFriend_id('<?php echo $user['user_id']; ?>');" value = "<?php echo $user['first_name']; ?>">
                        <?php $friend_id = $user['user_id']; ?>
                    </td></tr>
    
                <?php }
            }
        }
    }?>    
</table>  

<?php if(isset($friend_id) AND !empty($friend_id)): ?>

    <section id="messages"><?php include ("message.php");?></section>
    
    
    <form method="post" action="index.php">
        
        <textarea name="message"></textarea>
        <input type="hidden" name="friend_id" value=<?php echo($friend_id); ?>>
        <input type="submit" name="send">

    </form>

<?php else: ?>

    <?php echo("Choose a person which one you want to chat !");?>

<?php endif; ?>  