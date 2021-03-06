<?php

if (!isset($_SESSION["refresh_friend_array"])){
    $_SESSION["refresh_friend_array"] = 1;
}

if (!isset($_SESSION["refresh_friend_array_TBC"])){
    $_SESSION["refresh_friend_array_TBC"] = 1;
}

if (!isset($_SESSION["refresh_friend_array_Hold"])){
    $_SESSION["refresh_friend_array_Hold"] = 1;
}
 
if(isset($_POST['menu']) && isset($_SESSION['LOGGED_USER'][0])){
    if($_POST['menu'] == "Home"){
        $_SESSION["return_page"] = "Home";
    }
    else if($_POST['menu'] == "Members"){
        $_SESSION["return_page"] = "Members";
    }
    else if($_POST['menu'] == "Messaging"){
        $_SESSION["return_page"] = "Messaging";
    }
    else if($_POST['menu'] == "Myprofile"){
        $_SESSION["return_page"] = "Profile";
    }
}

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
                    $_SESSION["return_page"] = "Signin";
                }
                else {
                    $error = 'Wrong password';
                    $_SESSION["return_page"] = "Signup";
                }
            }
            else {
                $error = 'Please enter all informations';
                $_SESSION["return_page"] = "Signup";
            }
        }
        else {
            $error = 'Please enter correct informations';
            $_SESSION["return_page"] = "Signup";
        }
        
    }

    // ##### Login validation #####
    if ($_POST['login_form'] == "Signin"){
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $errorvalidation = TRUE;
            foreach ($users as $user) {
                if ($user['email'] === $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['LOGGED_USER'] = array($user['user_id'], $user['first_name'], $user['last_name'], $user['email'], $user['birth_year']);
                    $errorvalidation = FALSE;
                }
            }
            if ($errorvalidation){
                $error = 'Incorrect email or password';
                $_SESSION["return_page"] = "Signin";
            }
            else{
                $_SESSION["return_page"] = "Home";
            }
        }
        else{
            $error = 'Please enter correct informations';
            $_SESSION["return_page"] = "Signin";
        }
    }
    header("Refresh:0"); // Refresh the page to actualise
}


// ##### Validate request friend #####
if(isset($_SESSION['LOGGED_USER'][0]) && isset($_POST['validate_request'])){
    if ($_POST['validate_request'] != ""){
        $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_1` = ' . $_POST['validate_request'] . ' AND `user_2` = ' . $_SESSION["LOGGED_USER"][0] . ' AND `active`= 0';
        $searchRelationshipValidate = $mysqlClient->prepare($sqlQuery);
        $searchRelationshipValidate->execute();
        $relationshipsValidate = $searchRelationshipValidate->fetchAll();

        foreach ($relationshipsValidate as $relationshipValidate){
            $validate_friend_id = $relationshipValidate["relationship_id"];
        }


        $sqlQuery = 'UPDATE `relationships` SET user_1=:user_1, user_2=:user_2, active=:active WHERE relationship_id = ' . $validate_friend_id;
        $validateRelationship = $mysqlClient->prepare($sqlQuery);
        $validateRelationship->execute([
            'user_1' => $_POST['validate_request'],
            'user_2' => $_SESSION['LOGGED_USER'][0],
            'active' => '1', // 1 when the user_2 accept
        ]);
        $_SESSION["refresh_friend_array"] = 1;
        $_SESSION["refresh_friend_array_TBC"] = 1;
        $_SESSION["refresh_friend_array_Hold"] = 1;
        $_SESSION["return_page"] = "Profile";
        header("Refresh:0"); // Refresh the page to actualise
    }
    else{
        $error = 'Please enter a correct number';
        $_SESSION["return_page"] = "Profile";
    }
}


// ##### Request friend #####
if(isset($_SESSION['LOGGED_USER'][0]) && isset($_POST['id_user'])){
    if ($_POST['id_user'] != ""){
        $sqlQuery = 'INSERT INTO `relationships` (`user_1`, `user_2`, `active`) VALUES (:user_1, :user_2, :active)';
        $insertRelationship = $mysqlClient->prepare($sqlQuery);
        $insertRelationship->execute([
            'user_1' => $_SESSION['LOGGED_USER'][0],
            'user_2' => $_POST['id_user'],
            'active' => '0', // By default: 0 (not active). After, 1 when the user_2 accept
        ]);

        $_SESSION["refresh_friend_array"] = 1;
        $_SESSION["refresh_friend_array_TBC"] = 1;
        $_SESSION["refresh_friend_array_Hold"] = 1;
        
        echo "The request was send to " . $_POST['id_user'];
        $_SESSION["return_page"] = "Profile";
    }
    else{
        $error = 'Please enter a correct number';
        $_SESSION["return_page"] = "Profile";
    }
}


// ##### Put all relationships in the $_SESSION["relationShips"] array #####
if (!isset($_SESSION["relationShips"]) && isset($_SESSION["LOGGED_USER"][0]) || isset($_SESSION["refresh_friend_array"])){
    if ($_SESSION["refresh_friend_array"] == 1 && isset($_SESSION["LOGGED_USER"][0])){
        $_SESSION["relationShips"] = array();
        $counterRelationShips = 0;
        $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_1` = ' . $_SESSION["LOGGED_USER"][0] . ' AND `active`= 1 OR `user_2` = ' . $_SESSION["LOGGED_USER"][0] . ' AND `active`= 1';
        $searchRelationship = $mysqlClient->prepare($sqlQuery);
        $searchRelationship->execute();
        $relationships = $searchRelationship->fetchAll();

        foreach ($relationships as $relationship) {
            if ($relationship['user_2'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShips"][$counterRelationShips] = $relationship['user_1'];
                $counterRelationShips++;
            }
            else if ($relationship['user_1'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShips"][$counterRelationShips] = $relationship['user_2'];
                $counterRelationShips++;
            }
        }
        sort($_SESSION["relationShips"]);
        $_SESSION["refresh_friend_array"] = 0;
    }
    
}

// ##### Put all relationships to be confirmed by the LOGGED user in the $_SESSION["relationShipsTBC"] array ##### --> TBC : To Be Confirmed
if (!isset($_SESSION["relationShipsTBC"]) && isset($_SESSION["LOGGED_USER"][0]) || isset($_SESSION["refresh_friend_array_TBC"])){
    if ($_SESSION["refresh_friend_array_TBC"] == 1 && isset($_SESSION["LOGGED_USER"][0])){
        $_SESSION["relationShipsTBC"] = array();
        $counterRelationShipsTBC = 0;
        $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_2` = ' . $_SESSION["LOGGED_USER"][0] . ' AND `active`= 0';
        $searchRelationshipTBC = $mysqlClient->prepare($sqlQuery);
        $searchRelationshipTBC->execute();
        $relationshipsTBC = $searchRelationshipTBC->fetchAll();

        foreach ($relationshipsTBC as $relationshipTBC) {
            if ($relationshipTBC['user_2'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShipsTBC"][$counterRelationShipsTBC] = $relationshipTBC['user_1'];
                $counterRelationShipsTBC++;
            }
            else if ($relationshipTBC['user_1'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShipsTBC"][$counterRelationShipsTBC] = $relationshipTBC['user_2'];
                $counterRelationShipsTBC++;
            }
        }
        sort($_SESSION["relationShipsTBC"]);
        $_SESSION["refresh_friend_array_TBC"] = 0;
    }
}

// ##### Put all relationships to be confirmed by the OTHER user in the $_SESSION["relationShipsHold"] array ##### --> Hold : The other user must accept the relation.
if (!isset($_SESSION["relationShipsHold"]) && isset($_SESSION["LOGGED_USER"][0]) || isset($_SESSION["refresh_friend_array_Hold"])){
    if ($_SESSION["refresh_friend_array_Hold"] == 1 && isset($_SESSION["LOGGED_USER"][0])){
        $_SESSION["relationShipsHold"] = array();
        $counterRelationShipsHold = 0;
        $sqlQuery = 'SELECT * FROM `relationships` WHERE `user_1` = ' . $_SESSION["LOGGED_USER"][0] . ' AND `active`= 0';
        $searchRelationshipHold = $mysqlClient->prepare($sqlQuery);
        $searchRelationshipHold->execute();
        $relationshipsHold = $searchRelationshipHold->fetchAll();

        foreach ($relationshipsHold as $relationshipHold) {
            if ($relationshipHold['user_2'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShipsHold"][$counterRelationShipsHold] = $relationshipHold['user_1'];
                $counterRelationShipsHold++;
            }
            else if ($relationshipHold['user_1'] == $_SESSION["LOGGED_USER"][0]){
                $_SESSION["relationShipsHold"][$counterRelationShipsHold] = $relationshipHold['user_2'];
                $counterRelationShipsHold++;
            }
        }
        sort($_SESSION["relationShipsHold"]);
        $_SESSION["refresh_friend_array_Hold"] = 0;
    }
}


// ##### Send message (public) ##### publicSend
if(isset($_SESSION['LOGGED_USER'][0]) && isset($_POST['publicSend'])){
    if (isset($_POST['object']) && isset($_POST['content'])){
        if ($_POST['object'] != ""  && $_POST['content'] != ""){
            if(strlen($_POST['content']) < 512 && strlen($_POST['object']) < 256){
                $dateSend = date("YmdHis");
                if($_FILES['screenshot']['error'] == 0){ // Let's test if the file has been sent and if there are no errors
                    // Let's test if the file is not too big
                    if ($_FILES['screenshot']['size'] <= 10000000)
                    {
                        // Let's test if the extension is allowed
                        $fileInfo = pathinfo($_FILES['screenshot']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                        if (in_array($extension, $allowedExtensions))
                        {
                            // The file can be validated and stored permanently
                            $newName = $_SESSION['LOGGED_USER'][0] . '_' . $dateSend . '.' . $fileInfo['extension'];
                            $path_in_holder = 'uploads/' . $newName;
                            move_uploaded_file($_FILES['screenshot']['tmp_name'], $path_in_holder);
                            echo "<script language = javascript>alert('File uploaded successfully!');</script>";
                            
                            $sqlQuery = 'INSERT INTO `public_post` (`user_id`, `date`, `title`, `content`, `file_name`) VALUES (:user_id, :date, :title, :content, :file_name)';
                            $insertRelationship = $mysqlClient->prepare($sqlQuery);
                            $insertRelationship->execute([
                                'user_id' => $_SESSION['LOGGED_USER'][0],
                                'date' => $dateSend,
                                'title' => $_POST['object'],
                                'content' => $_POST['content'],
                                'file_name' => $newName,
                            ]);
                            header("Refresh:0"); // Refresh the page to actualise
                        }
                        else{
                            $error = 'File not allowed. Please send jpg, jpeg, gif or png';
                            $_SESSION["return_page"] = "Home";
                        }
                    }
                    else{
                        $error = 'File too big (Please send a file smaller than 10MB)';
                        $_SESSION["return_page"] = "Home";
                    }
                }
                else{
                    $sqlQuery = 'INSERT INTO `public_post` (`user_id`, `date`, `title`, `content`) VALUES (:user_id, :date, :title, :content)';
                    $insertRelationship = $mysqlClient->prepare($sqlQuery);
                    $insertRelationship->execute([
                        'user_id' => $_SESSION['LOGGED_USER'][0],
                        'date' => $dateSend,
                        'title' => $_POST['object'],
                        'content' => $_POST['content'],
                    ]);
                    $_SESSION["return_page"] = "Home";
                    header("Refresh:0"); // Refresh the page to actualise
                }
            }
            else{
                $error = 'Object or content too long (object<256 and content<512)';
                $_SESSION["return_page"] = "Home";
            }
        }
        else{
            $error = 'You must send an object and a content';
            $_SESSION["return_page"] = "Home";
        }
    }
    else{
        $error = 'You must send an object and a content';
        $_SESSION["return_page"] = "Home";
    }
}


// ##### Send message (private) ##### pprivateSend
if(isset($_SESSION['LOGGED_USER'][0]) && isset($_POST['private_message'])){
    if (isset($_POST['object']) && isset($_POST['content'])){
        if ($_POST['object'] != ""  && $_POST['content'] != ""){
            if(strlen($_POST['content']) < 512 && strlen($_POST['object']) < 256){
                $dateSend = date("YmdHis");
                if($_FILES['screenshot']['error'] == 0){ // Let's test if the file has been sent and if there are no errors
                    // Let's test if the file is not too big
                    if ($_FILES['screenshot']['size'] <= 10000000)
                    {
                        // Let's test if the extension is allowed
                        $fileInfo = pathinfo($_FILES['screenshot']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                        if (in_array($extension, $allowedExtensions))
                        {
                            // The file can be validated and stored permanently
                            $newName = $_SESSION['LOGGED_USER'][0] . '_' . $_SESSION["private_to"][0] . '_' . $dateSend . '.' . $fileInfo['extension'];
                            $path_in_holder = 'uploads/' . $newName;
                            move_uploaded_file($_FILES['screenshot']['tmp_name'], $path_in_holder);
                            echo "<script language = javascript>alert('File uploaded successfully!');</script>";
                            
                            $sqlQuery = 'INSERT INTO `private_post` (`userfrom_id`, `userto_id`, `date`, `title`, `content`, `file_name`) VALUES (:userfrom_id, :userto_id, :date, :title, :content, :file_name)';
                            $insertRelationship = $mysqlClient->prepare($sqlQuery);
                            $insertRelationship->execute([
                                'userfrom_id' => $_SESSION['LOGGED_USER'][0],
                                'userto_id' => $_SESSION["private_to"][0],
                                'date' => $dateSend,
                                'title' => $_POST['object'],
                                'content' => $_POST['content'],
                                'file_name' => $newName,
                            ]);
                            header("Refresh:0"); // Refresh the page to actualise
                        }
                        else{
                            $error = 'File not allowed. Please send jpg, jpeg, gif or png';
                            $_SESSION["return_page"] = "Messaging";
                        }
                    }
                    else{
                        $error = 'File too big (Please send a file smaller than 10MB)';
                        $_SESSION["return_page"] = "Messaging";
                    }
                }
                else{
                    $sqlQuery = 'INSERT INTO `private_post` (`userfrom_id`, `userto_id`, `date`, `title`, `content`) VALUES (:userfrom_id, :userto_id, :date, :title, :content)';
                    $insertRelationship = $mysqlClient->prepare($sqlQuery);
                    $insertRelationship->execute([
                        'userfrom_id' => $_SESSION['LOGGED_USER'][0],
                        'userto_id' => $_SESSION["private_message_user"][0],
                        'date' => $dateSend,
                        'title' => $_POST['object'],
                        'content' => $_POST['content'],
                    ]);
                    $_SESSION["return_page"] = "Messaging";
                    header("Refresh:0"); // Refresh the page to actualise
                }
            }
            else{
                $error = 'Object or content too long (object<256 and content<512)';
                $_SESSION["return_page"] = "Messaging";
            }
        }
        else{
            $error = 'You must send an object and a content';
            $_SESSION["return_page"] = "Messaging";
        }
    }
    else{
        $error = 'You must send an object and a content';
        $_SESSION["return_page"] = "Messaging";
    }
}


// ##### Print Error #####
if(isset($error)){
    echo $error;
}

?>