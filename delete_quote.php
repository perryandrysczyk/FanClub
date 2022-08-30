<?php
include('templates/header.php');
include('../mysqli_connect.php');
	
	 if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) && isset($_SESSION['email'])) { 
            $query = "SELECT text, author, favorite FROM quotes WHERE id={$_GET['id']}";
            if ($r = mysqli_query($dbc, $query)) { 
                    $row = mysqli_fetch_array($r); 
                    
                    print '<form action="delete_quote.php" method="post">
                    <p>Are you sure you want to delete this quote?</p>
                    <div><blockquote>' . $row['text'] . '</blockquote>- ' . $row['author'];

                // Is this a favorite?
                if ($row['favorite'] == 'Y') {
                    print ' <strong>Favorite!</strong>';
                }

                print '</div><br><input type="hidden" name="id" value="' . $_GET['id'] . '">
                <p><input type="submit" name="submit" value="Delete this Quote"></p>
                </form>';

                } else { 
                   print '<p class="error">Something went wrong</p>';
                }

	 } elseif (isset($_POST['id'])) {
         // Define the query:
	 $query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
	 $result = mysqli_query($dbc, $query); // Execute the query.
	
	 // Report on the result:
	 if (mysqli_affected_rows($dbc) == 1) {
             print '<p>The quote entry has been deleted.</p>';
	 } else {
             print '<p class="error">Something went wrong!</p>';
	 }
	
	 } 
	
	 mysqli_close($dbc); // Close the connection.
	
	 include('templates/footer.html');
?>