<?php
include('templates/header.php');


?>
<html>
    <h2>Create account</h2>
    <form action="" method="POST" class="form--inline">
        <p> <label>Username:</label>
        <input name="username" type="text"></p>
        <p> <label>Password:</label>
            <input name="password" type="text"></p>
        <p> <input value="Register" type="submit"> </p>
    </form>
        
</html>
<?php
include('../mysqli_connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = trim(strip_tags($_POST['username']));
        $password = trim(strip_tags($_POST['password']));
    }else{
        print '<p class="text--error">Please enter a username and password.</p>';
    }
}   
   $password = password_hash($password, PASSWORD_DEFAULT);
   $dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');
   
   $usernameCheck = "SELECT username FROM users";
   $usernameAvailable = true;
   $r = mysqli_query($dbc, $usernameCheck);
  
   while($row = mysqli_fetch_array($r)){
       if($row['username'] == $username){
           $usernameAvailable = false;
       }
   }
   
   if($usernameAvailable){
       $query = "INSERT INTO users (username, password, user_dir, status, admin) VALUES('$username', '$password', '$username', 'OPEN', 'N')";
       $dir = '../users/' . $username;
       $uploadsDir = '../users/' . $username . '/uploads';
       mkdir($dir);
       mkdir($uploadsDir);
   }else{
       print '<p class="text--error">Username already exists. Please try again. </p>';
   }
   include('templates/footer.html');

   if(mysqli_query($dbc, $query)){
       print '<p>Thanks for registering!</p>';
   }else{
       print '<p class="text--error">Something went wrong</p>';
   }