<?php  

session_start();
include '../functions/db.php';
$user = $_SESSION['user_Id'];
extract($_POST);
$query = "INSERT INTO `messages`(content,sender_id,receiver_id,chats_id) VALUES ('$val',$user,$other,$chat_id)";

$result = $con->query($query);
if ($result) {
	echo '<div id="my-message"><p>'.$val.'</p></div>';
}
else
{
	echo "message was not sent";
}
?>