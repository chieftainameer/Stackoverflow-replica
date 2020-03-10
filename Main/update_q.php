<?php  
session_start();
include '../functions/db.php';
$question = $_GET['question'];
extract($_POST);
$title = $con->real_escape_string($title);
$description = $con->real_escape_string($description);
$query = "UPDATE `questions` SET `title` = '$title', `description` = '$description', `tags` = '$tags' WHERE question_id = $question ";

if ($con->query($query)) {
	unset($_SESSION['updated']);
	$_SESSION['updated'] = "Question Updated";
	header('location:questions_page.php');
}
else
{
	$_SESSION['update_error'] = 'Could not update question';
	header('location:update_question.php');
}

?>