<?php

    include('config.php');

    session_start();
    $error = "";
    
   
    
    //Check if SUBMIT key exists, if not dies the page
    if(array_key_exists("submit", $_POST)){
        
        
         
    if(mysqli_connect_error()){
        
        die("");
        
    }
        
        
     
        //Check if email field is empty
        if(!$_POST['email']){
            
            
            $error .= "Email need is needed, ";
            
        }
        
        //Check if password field is empty
        if(!$_POST['password']){
            
            $error .= "Password is needed.";
            
        }
        
        //Check if error var is empty.
        if($error != ""){
            
            $error = "<p>ERRO IN FOLLOWING</p>".$error;
            
            
        }else{
            
            //Get all user informations from the email
             $query = "SELECT * FROM user WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            
              $result = mysqli_query($link, $query);
              
              $row = mysqli_fetch_array($result);
              
              
              if(isset($row)){
                
                //encrypt the entered password and proof if it match with the password in the database
                $hashedpassword = md5(md5($row['id']).$_POST['password']);
                
                if($hashedpassword == $row['password']){
                    
                    $_SESSION['id'] = $row['id'];
                    
                  //If all was successfully you will be get logged in
                    header("Location: myprofile.php");
                  
                  
                    
                }
                
                
            }

            
        }
        
    }

?>

<doctype=html>

<head>

    <title>GERMASOFT LOGIN SCRIPT</title>
    <link rel="stylesheet" type="text/css" href="style/MainStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>


    <body>
        
        
        <ul id="NavigationBAR">
            
        
           <li><a href="https://github.com/Germasoft">HOME</a></li>
           <li><a href="regist.php">REGIST</a></li>
        
        </ul>
        
    
   
    
    
    
        
    <div class="MainDiv">
        
        
            <p><?php  echo $error;  ?></p>
                       
                <form method = "post">
                    
                    <p>Email-Adress:</p>
                    <input type="text" name="email" placeholder="example@germasoft.com">
                    
                     <p>Password:</p>
                     
                    <input type="password" name="password" placeholder="Some Password">
                    
                    
                    <input type="submit" name="submit" value="LOGIN">
                    
                    <p>Template by <a href="https://github.com/Germasoft">Germasoft on GitHub</a></p>
                    
                </form>
            
        
    </div>
        
        
    
    </body>