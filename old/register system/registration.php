<?php
$error = NULL;
//yt video: https://www.youtube.com/watch?v=LXQfEFEfFcM
if(isset($_POST['submit'])){

    //Get the form data
    $u = $_POST['u'];
    $p = $_POST['p'];
    $p2 = $_POST['p2'];
    $e = $_POST['e'];

    if(strlen($u) < 3){
        $error = "<p>Your username must be atleast 3 charters</p>";
    }elseif($p2 != $p){
        $error .= "<p>Oh-o your passwords don't match</p>";
    }else{
        //Form is valid

        //Connect to database
        $mysqli = NEW MySQLI('localhost','thewherewhat','','thewherewhat2021');

        //Sanitize form data
        $u = $mysqli->real_escape_string($u);
        $p = $mysqli->real_escape_string($p);
        $p2 = $mysqli->real_escape_string($p2);
        $e = $mysqli->real_escape_string($e);

        //Generate Vkey
        
        $vkey = md5(time().$u);
    
        //Inster account into database

        $p = md5 ($p);
        $insert = $mysqli->query("INSERT INTO acounts(username,password,email,vkey) VALUES('$u','$p','$e','$vkey')");
        }
        if($insert){
            //Send Email      
            $to = $e;
            $subject = "Email verification";
            $message = "<a href='http://localhost/verify.php?vkey=$vkey'>Register Account</a>";
            $headers = "From: officialthewherewhat@gmail.com \r\n";
            $headers .= "Mime-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            mail($to,$subject,$message,$headers);

            header('location:thankyou.php');

        
            }else {
            echo $mysqli-> error;
        }
        
        

        
    }  


?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div style="text-align:center;">

<form method="POST" action="">
    <table border="0" aling="center" cellpadding="5">
    <tr>
        <td aling="right">Username:</td>
        <td><input type="TEXT" name="u" required/></td>
    </tr>
    <tr>
        <td aling="right">Passwod:</td>
        <td><input type="PASSWORD" name="p" required/></td>
    </tr>
    <tr>
        <td aling="right">Repeat Passwod:</td>
        <td><input type="PASSWORD" name="p2" required/></td>
    </tr>
    <tr>
        <td aling="right">Email Address:</td>
        <td><input type="EMAIL" name="e" required/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="SUBMIT" name="submit" value="register" required/></td>
    </tr>
</table>
</form>
<center> </center>
</php> 

