<?php

    include('config.php');
    session_start();


    $error = "";
    
   
    
    //Checks connection of the mysql server
    if(array_key_exists("submit", $_POST)){
        
        
        
        
         
    if(mysqli_connect_error()){
        
        
        // kill the page while unable to connect to the mysql server
        die("DATABASE CONNECTION ERROR");
        
    }
        
        
                // Check if it is a mail in the email field
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) { 
                       $error .= "No valiad email type";
                }
             
                // Check if the email field is empty
                if(!$_POST['email']){

                    $error .= " Please enter email.";
                    
                }
                
                // Check if the password field is empty
                if(!$_POST['password']){
                    
                    $error .= " Please enter password.";
                    
                }
                
                 // Check if the repeat-password field is empty
                 if(!$_POST['repeatpassword']){
                    
                    $error .= "Please repeat passoword,";
                    
                    
                }
                
                 // Check if the second password matches with first one
                 if($_POST['password'] !== $_POST['repeatpassword'] ){
                    
                    $error .= "Password not match";
                    
                }
                
                // Check if an error has occured while filling in the fields
                if($error != ""){
                    
                    $error = "<p>ERRO IN FOLLOWING</p>".$error;
                    
                    
                }else{
                    
                    // Check if an user already using this mail
                    
                    $query = "SELECT id FROM user WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                    
                    $result = mysqli_query($link, $query);
                    
                    if(mysqli_num_rows($result) > 0){
                        
                        
                        $error = "Email already in use";
                        
                        
                    }else{
                        
                         // insert the username and password in the mysql databse
                        $query = "INSERT INTO `user`(`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
                        
                        
                        //If there is an error when inserting the user data. Does he get this error message
                        if(!mysqli_query($link, $query)){
                            
                            
                            
                            $error = "<p>ERROR WHILE REGISTING, TRY LATER AGAIN</p>";
                            
                            
                        }else{
                            
                            
                            //Loads again the new user data and encrypts the password with md5 and its ID. Also will the user going to the myprofile.php
                            
                            $query = "UPDATE user SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                            
                            mysqli_query($link, $query);
                            
                            $_SESSION['id'] = mysqli_insert_id($link);
                            
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
            <li><a href="login.php">LOGIN</a></li>

        </ul>


        
        <div style="height: 30%;" class="MainDiv">

         
            <p><?php  echo $error;  ?></p>
                       
                <form method = "post">
                    
                    <br><p>Email-Adress:</p><br>
                    <input type="text" name="email" placeholder="example@germasoft.com">
                    
                    <br><p>Password:</p><br>
                    <input type="password" name="password" placeholder=" Enter Password">
                    
                    <br><p>Repeat Password:</p><br>
                    <input type="password" name="repeatpassword" placeholder="Repeat Password">
                    
                    <input type="submit" name="submit" value="Regist to germasoft">
                    
                    <p>Template by <a href="https://github.com/Germasoft">Germasoft on GitHub</a></p>
                    
                </form>
                            
                        
        </div>
                        
                        
                    
    </body>
 