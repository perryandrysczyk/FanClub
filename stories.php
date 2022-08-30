<?php
include('templates/header.php');
if(isset($_SESSION['email'])){
    $username = $_SESSION['email'];
    $search_dir = '../users/'.$username.'/uploads';
    $directory_contents = scandir($search_dir);

    print '<hr><h2>Stories Uploaded</h2>
             <table cellpadding="2" cellspacing="2"align="left">
             <tr>
             <th>Name</th>
             <th>Last Modified</th>
             </tr>';

            foreach ($directory_contents as $content) {
                if ((is_file($search_dir . '/' . $content))) {
                    $last_modified = date('F j, Y', filemtime($search_dir . '/' . $content));
                    print "<tr>
                    <td>$content</td>
                    <td>$last_modified</td>
                    </tr>";
                } 
            } 

    print '</table>'; 

}else{
    print "Please <a href='login.php'>log in</a> to view this function!";
}


include('templates/footer.html');

?>