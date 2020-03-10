<?php  

session_start();
include '../functions/db.php';
$current_user = $_SESSION['user_Id'];
extract($_POST);
$query_all = "SELECT COUNT(*) AS total FROM `messages` WHERE chats_id = $chat";
$query_msg = $con->query($query_all);
$total_msg = $query_msg->fetch_assoc();
$total_msg = $total_msg['total'];
/*if($total_msg > 15){
$start = $total_msg - (1 * 15);
$query = "SELECT * FROM `messages` WHERE chats_id = $chat limit $start,15";
$result = $con->query($query);
$output = '';
if ($result->num_rows > 0) {
	while ($messages = $result->fetch_assoc()) {
		extract($messages);
		if ($sender_id == $current_user) {
			$output .='<div id="my-message"><p>'.$content.'</p></div>';
		}
		else
		{
			$output .='<div id="his-message"><p>'.$content.'</p></div>';
		}
	}
}
else
{
	$output = "No messages to show";
}

}*/


	$query = "SELECT * FROM `messages` WHERE chats_id = $chat";
$result = $con->query($query);
$output = '';
if ($result->num_rows > 0) {
	while ($messages = $result->fetch_assoc()) {
		extract($messages);
		if ($sender_id == $current_user) {
			$output .='<div id="my-message"><p>'.$content.'</p></div>';
		}
		else
		{
			$output .='<div id="his-message"><p>'.$content.'</p></div>';
		}
	}
}
else
{
	$output = '<div style="text-align:center;">No messages to show</div>';
}

echo $output .= '<input type="hidden" id="chat-id-value" name="chat" value="'. $chat.'" data-other="'.$other.'" >';

?>