<?php  

include '../functions/db.php';
session_start();
extract($_POST);
$query = "SELECT * FROM `questions` WHERE tags LIKE '%$tags%' ";
$query_result = $con->query($query);
$result = "";
if ($query_result->num_rows > 0) {
	while ($row = $query_result->fetch_assoc()) {
		extract($row);
		$tag_arr = explode(',', $tags);
		$length = sizeof($tag_arr);
		if (strlen($description) > 200) {
			$description = substr($description,0,200).".....";
		}

		$result .='<div class="row question"><div class="col-md-12"><a href="question.php?question='.$question_id.'"><h4>'.$title.'</h4></a><p>'.$description.'</p>';
		for($i = 0;$i < $length; $i++){
			$result .='<p class="taggo">'.$tag_arr[$i].'</p>';
		}
		if(isset($_SESSION['username'])){
		if ($user_id == intval($_SESSION['user_Id'])) {
			$result .='<div class="row"><div class="col-md-2"><a href="update_question.php?question='.$question_id.'" class ="btn btn-primary">Update</a></div><div class="col-md-2"><a href="delete_question.php?question='.$question_id.'" class="btn btn-danger">Delete</a></div></div> ';
		}
	}
		$result .='</div></div>';
	}
}
else
{
	$result = "No Data Found";
}
echo $result;

?>