<?php


session_start();
require_once "bootstrap.php";

require_once "pdo.php" ;

if ( ! isset($_SESSION['who']) ) {
  die('Not logged in');
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Gowtham</title>
<?php 
require_once "bootstrap.php"; 
require_once "pdo.php";
?>
</head>
<body>
<div class="container">
<?php

if ( isset($_SESSION['who']) ) 
{
    echo "<p>Tracking Autos for  ";
    echo htmlentities($_SESSION['who']);
    
    echo "</p>\n";
}

if( !(isset($_SESSION['who']) ) )
{ ?>

    <p> Please <a href="login.php">Log In</a> to start. </p>
    <?php
    
}


$statement = $pdo->query("SELECT auto_id, make, year, mileage FROM autos");
            
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<li> ";
                echo $row['year']." ";
                echo htmlentities($row['make'])." / ";
                echo $row['mileage'];
                echo "</li>";
            }

?>
<p>
Attempt to go to 
<a href="add.php">Add New</a>
<a href="logout.php">logout</a> 


</p>
</div>
</body>

