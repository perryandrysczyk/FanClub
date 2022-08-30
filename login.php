<?php
include('templates/header.php');
?>
<html>
    <h2>Log in</h2>
    <form action="" method="POST" class="form--inline">
        <p> <label>Username:</label>
        <input name="username" type="text"></p>
        <p> <label>Password:</label>
            <input name="password" type="text"></p>
        <p> <input value="Log In" type="submit"> </p>
    </form>
</html>
<?php
include('../mysqli_connect.php');
$username = $_POST['username'];
$password = $_POST['password'];
$dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');
//$_SESSION['email'] = $_POST['username'];
$_SESSION['loggedin'] = time();
$usernameValid = false;
$passwordValid = false;
$usernameCheck = "SELECT username, password, status FROM users";
//$passwordCheck = "SELECT password FROM users";
if ((!empty($_POST['username'])) && (!empty($_POST['password'])) ) {
     if($r = mysqli_query($dbc, $usernameCheck)){
       while( $row = mysqli_fetch_array($r)){
            if($username == $row['username']){
                if($row['status'] !== 'OPEN'){
                    print '<p class="text--error">Your account is locked.</p>';
                    break;
                }
                $usernameValid = true;
                if(password_verify($password, $row['password'])){
                    $passwordValid = true;
                     
                }
            }
       }
      
   }    
}
    if ($usernameValid && $passwordValid) { // Correct!
            $_SESSION['email'] = $username;
            header("Location: index.php");
            exit;
    } else {
        print '<p class="text--error">The submitted email address and password do not match those on file!<br>Go back and try again.</p>';
    }
include('templates/footer.html');
