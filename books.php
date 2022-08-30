<?php
include('templates/header.php');

?>
<html>
    <form action="" method="post" class="form--inline">
         <p> <label>Author:</label>
            <input name="author" type="text"></p>
        <p> <label>Book:</label>
            <input name="book" type="text"></p>
        <p> <input value="add" type="submit"> </p>
    </form>
</html>


<?php
    if(!isset($_SESSION['email'])){
     print 'Please <a href="login.php">Login</a> see your books</h2>';
     exit();
    }else{
 
    $email = $_SESSION['email'];
    $search_dir = '../users/' . $email;
    $directory_contents = scandir($search_dir);
    $file = fopen($search_dir. '/books.csv', 'a');
    $author = $_POST['author'];
    $book = $_POST['book'];
    
    $newBook[] = array($book, $author);
    $addToFile = fopen($search_dir. '/books.csv', 'a');
    foreach ($newBook as $row) {
        fputcsv($addToFile, $row, "\t");
    }
    
    $readArray = file($search_dir.'/books.csv');
    print '<h2>My Books</h2>';
    foreach($readArray as $row){
        $display = str_replace('"', '' , $row);
        print "<p>$display</p>";
    }
    fclose($addToFile);
} 
	
include('templates/footer.html');