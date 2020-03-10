<?php  

include '../functions/db.php';
session_start();
$current_user_id = $_SESSION['user_Id'];
//extract($_POST);
if (isset($_FILES['pico'])) {
	$target_dir = '../images/';
	$file_toUpload = $_FILES['pico']['name'];
	$file_from =  $_FILES['pico']['tmp_name'];
	$target_dir .= $file_toUpload;
	if (move_uploaded_file($file_from, $target_dir)) {
		$query = "UPDATE `tbluser` SET `profile_pic` = '$target_dir' WHERE user_Id = $current_user_id ";
		if ($con->query($query)) {
			unset($_SESSION['profile']);
			$_SESSION['profile'] = $target_dir;
			header('location:profile.php');
		}
	}
}
else
{
	echo "no file";
}

?>