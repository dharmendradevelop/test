<?php
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require_once('connections.php'); //require connection script

if(isset($_POST['submit'])){  
          

    //check fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password FROM admin WHERE username = :username";
    $stmt = $dbcon->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
       echo '<script>alert("invalid username or password")</script>';
    } else{
         
        //Compare and decrypt passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
             
           echo '<script>window.location.replace("index.php");</script>';
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo '<script>
            alert("invalid username or password");
            window.location.replace("login.php");
            </script>';
        }
    }
    }
?>

<form action="login.php" method="post">                          
 <input type="text" name="username" placeholder="Username">
 <input type="password" name="password" placeholder="Password">    
 <button name="submit" type="submit">sign in</button>
 </form>