<?php
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require_once('connections.php'); //require connection script

 if(isset($_POST['submit'])){  
        try {
              
         $user = $_POST['username'];
         $email = $_POST['email'];
         $pass = $_POST['password'];
         
         //encrypt password
         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT * FROM admin WHERE username = :username";
         
         $stmt = $dbcon->prepare($sql);

         $stmt->bindValue(':username', $user);
         $stmt->execute();
         //$row = $stmt->fetch(PDO::FETCH_ASSOC);
         $row = $stmt->rowcount();
         if($row['id'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        
       else{

    $stmt = $dbcon->prepare("INSERT INTO admin (username, email, password) 
    VALUES (:username,:email, :password)");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pass);
    
    

   if($stmt->execute()){
    echo '<script>alert("New account created.")</script>';
    //redirect to another page
    echo '<script>window.location.replace("index.php")</script>';
     
   }else{
       echo '<script>alert("An error occurred")</script>';
   }
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '<script type="text/javascript">alert("'.$error.'");</script>';
}
     }

?>

<form action="registration.php" method="post">
  <input type="text" required="required" name="username" placeholder="Username">
  <input required="required" type="email" name="email" placeholder="Email">
  <input required="required" type="password" name="password" placeholder="Password">                  
  <button name="submit" type="submit">Register Now</button>
  </form>