<?php
include('templates/header.php');
include('../mysqli_connect.php');
$dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');

if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_SESSION['email'])) {
      $query = "SELECT text, author, favorite FROM quotes WHERE id={$_GET['id']}";
      if ($r = mysqli_query($dbc, $query)) { 
            $row = mysqli_fetch_array($r);
            
       print '<form action="" method="post" class="form--inline">
               <h2>Edit Quote</h2>';
               
       print   '<p> <label>Author: </label> 
                <input name="author" type="text" value=' . $row['author']. '></p>
                 <p> <label>Quote:</label>
                <input name="quote" type="text" value=' . $row['text']. '></p>
                <p> <input type="checkbox" name="newFavorite" value="Click to add as favorite">
                <label>Click to add as favorite</label></p>
                <p> <input value="Update Quote" type="submit"> </p>';
               
       
        } else { 
            print '<p class="error">Something went wrong</p>';
        }
        $newQuote = $_POST['quote'];
        $newAuthor = $_POST['author'];
        
        
        
        if(isset($_POST['newFavorite'])){
            $favorite = 'Y';
        }else{
            $favorite = 'N';
        }
    
        $newQuery = "UPDATE quotes SET favorite='$favorite', text='$newQuote', author='$newAuthor' WHERE id={$_GET['id']}";
        
	if ($result = mysqli_query($dbc, $newQuery)) {
            print '<p>The quotation has been updated.</p>';
	 } else {
            print '<p class="error">Could not update the quotation because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	 }
}else{
     print '<h2>Please <a href="login.php">Login</a> to access this function!</h2>';
 }
	
	 mysqli_close($dbc); // Close the connection.
	
	 include('templates/footer.html');

