<?php

session_start();
require_once "bootstrap.php";

require_once "pdo.php" ;

// line added to turn on color syntax highlight

if ( ! isset($_SESSION['who']) ) {
  die('Not logged in');

}


$msg = "";
$suc = 0;

$msg = isset($_POST["addi"]) ? $msg : "";
// Demand a GET parameter
// if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) 
// {
//     die('Name parameter missing');
// }

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) 
{
   session_start();
     session_destroy();
     header('Location: index.php');
  
}

if(isset($_POST['addi']))
{

    if(!(is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) )
    {
      $msg = " Mileage and year must be numeric";
      $_SESSION["error"] = $msg;
      
      
    }

    elseif(strlen($_POST['make'])<1)

    {
       $msg = " Make is required";  
       $_SESSION["error"] = $msg;
       
    }

   else
   {
     
     $stmt = $pdo->prepare('INSERT INTO autos
      (make, year, mileage) VALUES ( :mk, :yr, :mi)');
      $stmt->execute(array(
           ':mk' => $_POST['make'],
           ':yr' => $_POST['year'],
           ':mi' => $_POST['mileage'])
            );
     $msg = "succesfull"; 
     $_SESSION["success"] = $msg;
      

   }
     header('Location: add.php');
     return;

}



?>






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
    echo "<p>Tracking Autos for  ";
    echo htmlentities($_REQUEST['name']);
    
    echo "</p>\n";
}

if ( isset($_SESSION['success']) ) {
  echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
  unset($_SESSION['success']);
}
  
if( isset($_SESSION['error']) )
{
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}



?>


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



 
