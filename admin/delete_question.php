<?php  

session_start();
include '../functions/db.php';
$question = $_GET['question'];
$query = "DELETE FROM `questions` WHERE question_id = $question";
if ($con->query($query)) {
	$_SESSION['deleted'] = "Question Deleted";
	header('location:home.php');
}
else
{
	$_SESSION['error_deleting'] = "Question could not deleted";
	header('location:home.php');
}

?>