<form action="#" method="POST" enctype="multipart/form-data">
    <label for="object">Object:</label>
    <input type="text" id="object" name="object" placeholder="The subject of your message...">

    <label for="content">Content</label>
    <textarea name="content" id="content" placeholder="Write your message here..."></textarea>
        
    <label for="screenshot">Insert a file here</label>
    <input type="file" id="screenshot" name="screenshot"/>
        
    <button type="submit" name="publicSend" value="send">Send</button>
</form>