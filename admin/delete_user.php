<?php  
session_start();
include '../functions/db.php';
$user = $_GET['user'];

$query = "DELETE FROM `tbluser` WHERE user_Id = $user ";

if ($con->query($query)) {
	$_SESSION['deleted'] = "User Deleted";
	header('location:home.php');
	echo "deleted";
}
else
{
	$_SESSION['error_deleting'] = "Could not delete user";
	header('location:home.php');
	echo "not deleted";
}

?>