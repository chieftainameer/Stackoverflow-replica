<?php
    session_start();
	
	include '../functions/db.php';

	$uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
	//$pwd = md5($password);

	$uname = $con->real_escape_string($_POST['uname']);
    $pwd = $con->real_escape_string($_POST['pwd']);

    $query = "SELECT * FROM tbladmin WHERE uname = '$uname' AND pwd = '$pwd'";
    $result = $con->query($query) or die ("Verification error");
    $array = $result->fetch_assoc();
    
    if ($array['uname'] == $uname){
        $_SESSION['uname'] = $uname;
        header("Location: home.php");
    }
    
    else{
    	echo '<script language="javascript">';
        echo 'alert("Incorrect username or password")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
    }


?>
