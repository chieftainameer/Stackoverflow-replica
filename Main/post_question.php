<?php 
session_start();
include "../functions/db.php";
extract($_POST);
extract($_SESSION);
$title = $con->real_escape_string($title);
$description = $con->real_escape_string($description);
$tags = $con->real_escape_string($tags);
$query = "INSERT INTO `questions`(title,description,tags,user_id) VALUES('$title','$description','$tags',$user_Id) ";

if ($con->query($query)) {
	echo "Posted";
}
else{
	echo "not posted";
}

?>