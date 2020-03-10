<?php  
session_start();
include '../functions/db.php';
extract($_POST);
$content = $con->real_escape_string($content);
$user = $_SESSION['user_Id'];
$date = date('Y-m-d');
$query = "INSERT INTO `answers`(content,user_id,date_ans,question_id) VALUES('$content',$user,'$date',$question_id)";

if ($con->query($query)) {
	echo '<div id="answer"><p>'.$content.'</p></div>';
}
else
{
	echo "Not posted";
}

?>