<?php  
session_start();
include '../functions/db.php';
extract($_POST);
$user_id = $_SESSION['user_Id'];
$query = "UPDATE `tbluser` SET `$column` = '$value' WHERE user_Id = $user_id ";
if ($con->query($query)) {
	$query_again = "SELECT * FROM `tbluser` WHERE user_Id = $user_id";
	$result_again = $con->query($query_again);
	$row = $result_again->fetch_assoc();
	extract($row);
	unset($_SESSION['username']);
	$_SESSION['username'] = $fname;
	$_SESSION['email'] = $email;
	$_SESSION['lname'] = $lname;
}

?>