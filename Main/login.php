<?php 

    session_start();
    
    include '../functions/db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = $con->real_escape_string(strtolower(strtolower($_POST['username'])));
    $password = $con->real_escape_string($_POST['password']);
    $pwd = md5($password);
    $query = "SELECT * FROM tbluser WHERE  email = '$username' AND password = '$pwd'";
    $result = $con->query($query) or die ("Verification error");
    $array = $result->fetch_assoc();
    
    if ($array['email'] == $username){
        $_SESSION['username'] = $array['fname'];
        $_SESSION['email'] = $array['email'];
        $_SESSION['lname'] = $array['lname'];
        $_SESSION['profile'] = $array['profile_pic'];
        $_SESSION['user_Id'] = $array['user_Id'];
        header("Location: index.php");
    }
    
    else{
        echo '<script language="javascript">';
        echo 'alert("Incorrect username or password")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0;url=login_layout.php" />';
    }
   
?>