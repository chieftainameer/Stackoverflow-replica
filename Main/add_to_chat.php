<?php  
session_start();
include '../functions/db.php';
$current_user = $_SESSION['user_Id'];
extract($_POST);
$query = "SELECT * FROM `chats` WHERE (sender_id = $current_user AND receiver_id = $other) OR (sender_id = $other AND receiver_id = $current_user) ";
$any = $con->query($query);
if ($any->num_rows > 0) {
	header('location:../chat/chats.php');
}
else
{
	$query = "INSERT INTO `chats`(sender_id,receiver_id) VALUES ($current_user,$other)";
	$result = $con->query($query);
	if ($result) {
		header('location:../chat/chats.php');
	}
	else
	{
		header('location:users.php');
	}
}

?>