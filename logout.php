<?php	 
	 session_start(); 
	 $_SESSION = [];
	 session_destroy();
	
	 // Define a page title and include the header:
	 define('TITLE', 'Logout');
	 include('templates/header.php');
	
	 ?>
	
	 <h2>Thank you for using our site!</h2>
	 <p>You are now logged out.</p>
	
	
	 <?php include('templates/footer.html');
?>