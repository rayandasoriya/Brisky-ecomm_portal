<?php
   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "login12";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername =$_POST['username'];
      $mypassword =$_POST['password']; 
      $enc_pwd=md5($mypassword);

      $sql = "SELECT id FROM signup WHERE email = '$myusername' and password = '$enc_pwd'";
      $result = mysqli_query($conn,$sql);
      
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['id'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) {
         //session_register("$myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: home.html");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
   
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" value="rayan@gmail.com" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" value="1478" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>