
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
<h1>Welcome to Autos Database</h1>

<p>
<a href="login.php">Please Log In</a>
</p>
<p>
Attempt to go to 
<a href="view.php">view.php</a> without logging in - it should fail with an error message.

</p>

<p>

<a href="add.php">add.php</a> without logging in - it should fail with an error message.

</p>

<p><strong>Note:</strong>  Your implementation should retain data across multiple logout/login sessions. This sample implementation clears all its data on logout - which you should not do in your implementation.
</p>
</div>
</body>

