<?php

session_start();


if(array_key_exists("logout", $_GET)){
    
    unset($_SESSION);
    setcookie("id", "", time() - 60*60);
    $_COOKIE['id'] = "";
    session_destroy();
    
}else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR array_key_exists("id", $_COOKIE)){
    
    
    
    header("Location: myprofile.php");
    
    
}


?>

<h1>You have successfully logged out. <a href="login.php">LOGIN AGAIN</a></h1>
 