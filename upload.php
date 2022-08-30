<?php
    include('templates/header.php');

    
    if(!isset($_SESSION['email'])){
         print 'Please <a href="login.php">Login</a> to upload a file.';
    }
?>
<html>
    <form action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_UPLOAD_IN_BYTES" value="3000">
        <p><input type="file" name="the_file"></p>
        <p><input type="submit" name="submit" value="Upload"></p>
    </form>
</html>


<?php
    if(isset($_SESSION['email'])){
         if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
             $username = $_SESSION['email'];
             $fileType = $_FILES['the_file']['type'];
            
	 // Try to move the uploaded file:
             if($fileType == 'application/pdf' || $fileType == 'text/plain' || $fileType == 'application/msword' || $fileType == 'application/octet-stream'){
                if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "../users/$username/uploads/{$_FILES['the_file']['name']}")) {
                   print '<p>Your file has been uploaded.</p>';
                } 
            }	
	 }else{
             print '<p>Uploads must be of type .pdf .doc .docx. or .txt</p>';
         }
	
	 }else{
             print '<h2>Please <a href="login.php">Login</a> to send an email</h2>';
         }
    
include('templates/footer.html');
