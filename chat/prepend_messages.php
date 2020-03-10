<?php  

session_start();
include '../functions/db.php';
$current = $_SESSION['user_Id'];
extract($_POST);
$limit = 15;
$query_all = "SELECT COUNT(*) AS total FROM `messages` WHERE chats_id = $chat_id";
$all_result = $con->query($query_all);
$total_messages = $all_result->fetch_assoc();
$total_messages = $total_messages['total'];
$start = $total_messages - ($page * $limit);
$_SESSION['start'] = $total_messages - $limit;
if ($start < 0) {
	$start = 0;
	$limit = $_SESSION['start'];
}
$_SESSION['start'] = $start;

$limited_messages = "SELECT * FROM `messages` WHERE chats_id = $chat_id LIMIT $start,$limit";
$res = $con->query($limited_messages);
$output = '';
if($res->num_rows > 0){
while ($row = $res->fetch_assoc()) {
	extract($row);
	if ($sender_id == $current) {
		$output .= '<div id="my-message"><p>'.$content.'</p></div>';
	}
	else
	{
		$output .='<div id="his-message"><p>'.$content.'</p></div>';
	}
}
}
else
{
	$output = '<div style="text-align:center;">No more Messages</div>';
}
echo $output;

?>