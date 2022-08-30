<?php
session_start();
include('../mysqli_connect.php');
$dbc = mysqli_connect('localhost', 'web_user', 'webpassword', 'fanclub');
?>

<!doctype html>
	 <html>
	 <head>
	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	 <meta name="viewport" content="width=device-width,initial-scale=1.0">
	 <meta name="HandheldFriendly"content="True">
	 <title>Raise High the Roof Beam!</title>
	 <link rel="stylesheet" type="text/css" media="screen" href="css/concise.min.css" />
	 <link rel="stylesheet" type="text/css" media="screen" href="css/masthead.css" />
	 </head>
	 <body>
<?php

       if(!isset($_SESSION['email'])){
            echo '<header container class="siteHeader">
             <div row>
                <h1 column=4 class="logo"><a href="index.php">Raise High the Roof Beam!</a></h1>
                <nav column="8" class="nav">
                    <ul>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="quotes.php">Quotes</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </nav>
              </div>
	 </header>';
       } else{
        $username = $_SESSION['email'];
        $adminCheck = "SELECT admin FROM users WHERE username='$username'";
        $r = mysqli_query($dbc, $adminCheck);
        $adminStatus = mysqli_fetch_array($r);
        if($adminStatus['admin'] == 'N'){
             echo '<header container class="siteHeader">
             <div row>
                <h1 column=4 class="logo"><a href="index.php">Raise High the Roof Beam!</a></h1>
                <nav column="8" class="nav">
                    <ul>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="stories.php">Stories</a></li>
                        <li><a href="quotes.php">Quotes</a></li>      
                        <li><a href="upload.php">Upload</a></li> 
                        <li><a href="email.php">Contact</a></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </nav>
              </div>
	 </header>';
       }else{
           echo '<header container class="siteHeader">
             <div row>
                <h1 column=4 class="logo"><a href="index.php">Raise High the Roof Beam!</a></h1>
                <nav column="8" class="nav">
                    <ul>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="stories.php">Stories</a></li>
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="quotes.php">Quotes</a></li>      
                        <li><a href="upload.php">Upload</a></li> 
                        <li><a href="email.php">Contact</a></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </nav>
              </div>
	 </header>';
       }
    }
          echo '<main container class="siteContent">';
?>
	 
	
