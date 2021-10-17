<?php

require_once "bootstrap.php";

require_once "pdo.php" ;
$msg = "";
$suc = 0;

$msg = isset($_POST["addi"]) ? $msg : "";
// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) 
{
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) 
{
    header('Location: index.php');
    return;
}

if(isset($_POST['addi']))
{

    if(!(is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) )
    {
      $msg = " Mileage and year must be numeric";
      
      
    }

    elseif(strlen($_POST['make'])<1)

    {
       $msg = " Make is required";  
       
       
    }

   else
   {
     $suc = 1;
     $stmt = $pdo->prepare('INSERT INTO autos
      (make, year, mileage) VALUES ( :mk, :yr, :mi)');
      $stmt->execute(array(
           ':mk' => $_POST['make'],
           ':yr' => $_POST['year'],
           ':mi' => $_POST['mileage'])
            );
     $msg = "succesfull"; 
      

   }
}



?>



<!-- // Set up the values for the game...
// 0 is Rock, 1 is Paper, and 2 is Scissors

 // Hard code the computer to rock
// TODO: Make the computer be random
// $computer = rand(0,2);

// This function takes as its input the computer and human play
// and returns "Tie", "You Lose", "You Win" depending on play
// where "You" is the human being addressed by the computer
 -->



<!DOCTYPE html>
<html>
<head>
<title>Gowtham</title>

</head>
<body>
<div class="container">
<h1>database</h1>
<?php

if ( isset($_REQUEST['name']) ) 
{
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    
    echo "</p>\n";
}

if($suc == 1)
{
echo('<p style="color: green;">'.htmlentities($msg)."</p>\n");

echo "<pre>\n";

$statement = $pdo->query("SELECT auto_id, make, year, mileage FROM autos");
            
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<li> ";
                echo $row['year']." ";
                echo htmlentities($row['make'])." / ";
                echo $row['mileage'];
                echo "</li>";
            }


}

else
{
   echo('<p style="color: red;">'.htmlentities($msg)."</p>\n"); 
}



?>
<!-- <form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form> -->

<form method="POST">
<label for="name_auto">make</label>
<input type="text" name="make" id="name_auto"><br/>
<label for="id_1723_auto">year</label>
<input type="text" name="year" id="id_1723_auto"><br/>
<label for="mileage_auto">mileage</label>
<input type="text" name="mileage" id="mileage_auto"><br/>
<input type="submit" value="add to DB" name ="addi">
<input type="submit" value="logout" name = "logout">

</form>

<pre>

</pre>
</div>
</body>
</html>
