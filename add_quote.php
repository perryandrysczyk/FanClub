<?php
include('templates/header.php');

?>
<html>
    <h2>Add a Quote:</h2>
    <form action="" method="POST" class="form--inline">
        <p> <label>Author: </label>
        <input name="author" type="text"></p>
        <p> <label>Quote:</label>
            <input name="quote" type="text"></p>
        <p> <input type="checkbox" name="favorite" value="Click to add as favorite">
            <label>Click to add as favorite</label></p>
        <p> <input value="Submit" type="submit"> </p>
    </form>
        
</html>
<?php
include('../mysqli_connect.php');
$quoteText = $_POST['quote'];
$author = $_POST['author'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');
    
    if(isset($_POST['favorite'])){
        $query = "INSERT INTO quotes (id, text, author, favorite, date_entered) VALUES(0 , '$quoteText', '$author', 'Y', NOW())";
    }else{
        $query = "INSERT INTO quotes (id, text, author, favorite, date_entered) VALUES(0 , '$quoteText', '$author', 'N', NOW())";
    }
    
    if(mysqli_query($dbc, $query)){
       print '<p>Quote added!</p>';
   }else{
       print '<p class="text--error">Something went wrong</p>';
   }
}
include('templates/footer.html');