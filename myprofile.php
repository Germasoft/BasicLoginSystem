<?php

    include('config.php');
    session_start();

    $error = "";
   
    


    //Check if a cookie exists, if so it will be set as id
    if(array_key_exists("id", $_COOKIE)){
        
        $_SESSION['id'] = $_COOKIE['id'];
        
       
        
        
    }
    
    
    //Check if you have a SESSION with the user ID ... if not you will be redirected back to login
    if(array_key_exists("id", $_SESSION)){
        
        
        
    }else{
        
        header("Location: login.php");
        
    }
    
    
    //Loads all user data from the user id or send them to the succeded.php in case the useraccount in new
    if($_SESSION['id']){
        
         $query = "SELECT * FROM user WHERE id = '".$_SESSION['id']."' LIMIT 1";
              $result = mysqli_query($link, $query);
              
              $row = mysqli_fetch_array($result);
        
        
        
    }else{
        
        header("Location: succeded.php?succeded=1");
        
    }
    



?>



<doctype=html>

<head>

    <title>GERMASOFT LOGIN TEMPLATE</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/MainStyle.css">
    
</head>



    <body>
        
        
        <ul id="NavigationBAR">
        
            <li><a href="myprofile.php"><?php print_r($row['email']); ?></a></li>
            <li><a href='logout.php?logout=1'>Logout</a></li>
            <li><a href='https://github.com/Germasoft'>GitHub | Germasoft</a></li>
        
        </ul>
        
        
    <h1>You are logged in as <?php print_r($row['email']); ?></h1>
        
   
        
    
    </body>
    