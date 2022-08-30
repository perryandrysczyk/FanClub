<?php
include('templates/header.php');

$dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');

if(isset($_SESSION['email'])){
    $usernameCheck = "SELECT username FROM users";
    $r = mysqli_query($dbc, $usernameCheck);
    print "<h2>Administratior functions</h2>";
    print "<form class='form--inline' action='admin.php' method='POST'>
            <label>Username:</label><select name='selectedValue'>";
     while ($row = mysqli_fetch_array($r)) {
        print "<option name='{$row['username']}'>{$row['username']}</option>";      
     }
       print "<input type='submit' value='Go'>
              </select>
              </form>";

    $user = $_POST['selectedValue'];
    $query = "SELECT username, status, admin FROM users WHERE username='$user'";
    $r = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($r);

    $username = str_replace("'", "", $row['username']);
    print "<form class=\"form--inline\" action=\"\" method=\"POST\">";
    print "<p>Account options for $username</p>";
         if($row['status'] == 'OPEN' && $row['admin']=='Y'){
           print"<input type=\"radio\" id=\"open\" name=\"open\" value=\"open\" checked>
                <label for=\"open\">Open</label><br>
                <input type=\"radio\" id=\"open\" name=\"open\" value=\"locked\">
                <label for=\"locked\">Locked</label><br>  
                <input type=\"radio\" id=\"admin\" name=\"admin\" value=\"N\">
                <label for=\"admin\">Revoke admin access</label><br>
                <input type=\"radio\" id=\"delete\" name=\"delete\" value=\"delete\">
                <label for=\"delete\">Delete this account</label><br>";
         }else if($row['status']=='OPEN' && $row['admin']=='N'){
            print"<input type=\"radio\" id=\"open\" name=\"open\" value=\"open\" checked>
                <label for=\"open\">Open</label><br>
                <input type=\"radio\" id=\"locked\" name=\"open\" value=\"locked\">
                <label for=\"locked\">Locked</label><br>  
                <input type=\"radio\" id=\"admin\" name=\"admin\" value=\"Y\">
                <label for=\"admin\">Grant admin access</label><br>
                <input type=\"radio\" id=\"delete\" name=\"delete\" value=\"delete\">
                <label for=\"delete\">Delete this account</label><br>";
         }else if($row['status']=='LOCKED' && $row['admin']=='N'){
            print"<input type=\"radio\" id=\"open\" name=\"open\" value=\"open\" >
                <label for=\"open\">Open</label><br>
                <input type=\"radio\" id=\"locked\" name=\"open\" value=\"locked\" checked>
                <label for=\"locked\">Locked</label><br>  
                <input type=\"radio\" id=\"admin\" name=\"admin\" value=\"Y\">
                <label for=\"admin\">Grant admin access</label><br>
                <input type=\"radio\" id=\"delete\" name=\"delete\" value=\"delete\">
                <label for=\"delete\">Delete this account</label><br>";
         }
         print "<input name='username' type='hidden' value='$username'> 
                <input type='submit' value='Submit'></form>";

         $username = $_POST['username'];
         $openOrLock = $_POST['open'];
         $admin = $_POST['admin'];
         $delete = $_POST['delete'];

         if($openOrLock == 'open'){
             $open = 'OPEN';
         }else{
             $open = 'LOCKED';
         }

         if($delete){
             $query = "DELETE FROM users WHERE username='$username' LIMIT 1";
             $uploads = '../users/' . $username. '/uploads';
             $user_dir = '../users/' . $username;
             $search_dir = scandir($uploads);
             foreach($search_dir as $file){
                 $fileToDelete = $uploads . '/' . $file;
                  unlink($fileToDelete);
             }
             rmdir($uploads);
             unlink($user_dir . '/books.csv');
             rmdir($user_dir);
         }else if($admin == 'Y'){
             $query = "UPDATE users SET  status='OPEN', admin='Y' WHERE username='$username'";
         }else{
             $query = "UPDATE users SET  status='$open', admin='N' WHERE username='$username'";
         }

        if($r = mysqli_query($dbc, $query)){
             print "The user has been updated";
         }else{
             print "There was a problem";
        }
}
include('templates/footer.html');

