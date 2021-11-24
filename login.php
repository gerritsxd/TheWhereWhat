<?php
$error = NULL;

if(isset($_POST['submit'])){
    //Connect to database
    $mysqli = NEW MySQLI('localhost','root','','test1');

    //Get from data
    $u = $mysqli->real_escape_string($_POST['u']);
    $p = $mysqli->real_escape_string($_POST['p']);
    $p = md5($p);

    //Querry database
    $resultSet = $mysqli->query("SELECT * FROM acounts WHERE username = '$u' AND pasword = '$p' LIMIT 1");

    if($resultSet->num_rows !=0){
        //Process Login
        $row = $resultSet->fetch_assoc();
        $verified = $row['verified'];
        $email = $row['email'];
        $date = $row['created'];
        $date = strtotime($date);
        $date = date('M d Y',$date);

        if($verified == 1){
            //Comtinue processing
            echo "Your account is verified and you have been logged in";
        }else{
            $error = "Please verify your acount to preceed.  An email was sent to $email on $date";
        }
    }else{
        //Invalid credentials
        $error = "The username or password you entered is incorrect";
    }


}

?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>


<body>
<form metho="POST" action="">
<table border="0" align="center" cellpadding="5">
    <tr>
        <td align="right">Username:</td>
        <td><input type="TEXT" name="u" required/></td>
    </tr>
    <tr>
        <td align="right">Password:</td>
        <td><input type="PASSWORD" name="p" required/></td>
    </tr>
        <td colspan="2" align="center"><input type="SUBMIT" name="submit" value="Login" required/></td>
    </tr>
</table>
</form>
<center>
    <?php echo $error; ?>
</center>

</body>
</html>

