<?php // Do not put any HTML above this line
session_start();


// if ( isset($_POST['guess']) ) {
// $guess = $_POST['guess'] + 0;
// $_SESSION['guess'] = $guess;
// if ( $guess == 42 ) {
// $_SESSION['message'] = "Great job!";
// } else if ( $guess < 42 ) {
// $_SESSION['message'] = "Too low";
// } else {
// $_SESSION['message'] = "Too high...";
// }
// header("Location: guess2.php");
// return;
// }





// if ( isset($_POST["who"]) && isset($_POST["pass"]) ) {
//                    // Logout current user
//         if ( $_POST['pass'] == 'php123' ) 
//         {
//             $_SESSION["who"] = $_POST["who"];
//             $_SESSION["who"]
           
//         } 
           
//        header( 'Location: login.php' ) ;
//             return;     
        
//     }


// require_once "pdo.php";
if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to autos.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is meow123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['who']) && isset($_POST['pass']) )
 {
       unset($_SESSION["who"]);
       unset($_SESSION["error"]);
       unset($_SESSION["success"]);
       unset($_SESSION["pass"]);

    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) 
    {
        $failure = "User name and password are required";
        $_SESSION["error"] = $failure;
    } 

    elseif (!(strpos($_POST['who'],'@') !== false))
    {
        $failure = "@ is missing";
         $_SESSION["error"] = $failure;
    }

    else 
    {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) 
        {
            // Redirect the browser to game.php
            $_SESSION["who"] = $_POST["who"];
            $_SESSION["success"] = "Logged in.";
            header("Location: view.php");
            error_log("Login success ".$_POST['who']);
            return;
        } 
        else 

        {
            

            error_log("Login fail ".$_POST['who']." $check");
            $_SESSION["error"] = "Incorrect password.";
            header( 'Location: login.php' ) ;
            return;
        }
    }

    if($_SESSION["error"] == "Incorrect password." || $_SESSION["error"] == "User name and password are required"|| $_SESSION["error"] == "@ is missing")
    {
          header( 'Location: login.php' ) ;
          return;
    }

    if($_SESSION["success"] == "Logged in.")
    {
        header("Location: view.php");
    }

}

// else
// {

//     if($_SESSION["error"] == "Incorrect password." || $_SESSION["error"] == "User name and password are required"|| $_SESSION["error"] == "@ is missing")
//     {
//           header( 'Location: login.php' ) ;
//     }

//     if($_SESSION["success"] == "Logged in.")
//     {
//         header("Location: view.php");
//     }
// }


// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
<title>gowtham</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php
// Note triple not equals and think how badly double
// not equals would work here...

    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }

    
?>
<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="who" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the four character sound a cat
makes (all lower case) followed by 123. -->
</p>
</div>
</body>
