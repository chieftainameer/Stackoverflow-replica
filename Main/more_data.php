<?php  
include '../functions/db.php';
session_start();
extract($_POST);
$query_for_total = $con->query("SELECT COUNT(*) AS total FROM `questions` ");
$total_records = $query_for_total->fetch_assoc();
$total_records = $total_records['total'];
$limit = 2;
$result = "";
$total_pages = ceil($total_records/$limit);
if (($page - 1) > $total_pages) {
	$result .= "No more data"."<br/>";
	$status = "nil";
}

$start = ($page - 1) * $limit;
$query = "SELECT * FROM `questions` LIMIT $start,$limit";
$query_result = $con->query($query);
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
		if ($user_id == intval($_SESSION['user_Id'])) {
			$result .='<div class="row"><div class="col-md-2"><a href="update_question.php?question='.$question_id.'" class ="btn btn-primary">Update</a></div><div class="col-md-2"><a href="delete_question.php?question='.$question_id.'" class="btn btn-danger">Delete</a></div></div> ';
		}
		$result .='</div></div>';
		
	}
}
else
{
	$status = "nil";
}

echo $result;

?>