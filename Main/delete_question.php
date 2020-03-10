<?php  
session_start();
include '../functions/db.php';


$question = $_GET['question'];

$query = "DELETE FROM `questions` WHERE question_id = $question ";
if ($con->query($query)) {
	$_SESSION['deleted'] = "Question Deleted";
	header('location:questions_page.php');
}
else
{
	$_SESSION['error_deleting'] = "Could not delete question";
	header('location:questions_page.php');
}

?>