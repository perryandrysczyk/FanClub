<?php
include('templates/header.php');

if(isset($_SESSION['email'])){
    print '<a href="add_quote.php">Add a quote</a>';
}

	 define('TITLE', 'View All Quotes');
	 print '<h2>Quotes</h2>';
         include('../mysqli_connect.php');
	
	
	 $query = 'SELECT id, text, author, favorite FROM quotes ORDER BY date_entered DESC';

if ($r = mysqli_query($dbc,$query)) {
	 // Retrieve the returned records:
            while ($row = mysqli_fetch_array($r)) {
               print "<div></br><blockquote>{$row['text']}</blockquote>-{$row['author']}";
                   if ($row['favorite'] == 'Y') {
                     print ' <strong>Favorite!</strong>';
                   }
                print "<p><a href=\"update_quote.php?id={$row['id']}\">Edit</a>
                <a href=\"delete_quote.php?id={$row['id']}\">Delete</a></p></div>";
               }
             
	 } else { 
            print '<p class="error">Something went wrong!</p>';
	 } 
	
	 mysqli_close($dbc); 
	
	 include('templates/footer.html');
?>
