<form action="#" method="POST" enctype="multipart/form-data">
    <label for="object">Object:</label>
    <input type="text" id="object" name="object" placeholder="The subject of your message...">

    <label for="content">Content</label>
    <textarea name="content" id="content" placeholder="Write your message here..."></textarea>
        
    <label for="screenshot">Insert a file here</label>
    <input type="file" id="screenshot" name="screenshot"/>
        
    <button type="submit">Send</button>
</form>

<?php
    // Let's test if the file has been sent and if there are no errors
    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
    {
        // Let's test if the file is not too big
        if ($_FILES['screenshot']['size'] <= 1000000)
        {
            // Let's test if the extension is allowed
            $fileInfo = pathinfo($_FILES['screenshot']['name']);
            $extension = $fileInfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($extension, $allowedExtensions))
            {
                // The file can be validated and stored permanently
                //move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/' . basename($_FILES['screenshot']['name']));
                //echo "The shipment was successful!\n";
                $newName = date("YmdHis").basename($_FILES['screenshot']['name']);
                $path_in_holder = 'uploads/'.$newName;
                move_uploaded_file($_FILES['screenshot']['name'], $path_in_holder);
                echo "<script language = javascript>alert('File uploaded successfully!');</script>";
            }
        }
    }
?>
