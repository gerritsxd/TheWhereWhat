<?php
if(isset($_GET['vkey'])){
    //Process verification
    $vkey = $_GET['vkey'];

    $mysqli = NEW MySQLI('localhost','thewherewhat','','thewherewhat2021');

    $resultSet = $mysqli->query("SELECT verified, vkey FROM acounts WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");

    if($resultSet->num_rows == 1){
        //Validate The EMAIL
        $update = $mysqli->query("UPDATE ACOUNTS SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");

        if($update){
            echo "NICE! Your Account has been verified";
        }else{
                echo $mysqli->error;
        
        } 
    }else{
        echo "This account is invalid or alrready verified";
    }

    
    
}else{
    die("Ups something went no bueno"); 
}

?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<body>
<center>

</center>
</body>
</html>