<?php
session_start();
include "db.php";

extract($_POST);
$profile_picture = "avatar.jgp";
		if (isset($_FILES['pic'])) {
			
			$target_dir = "../images/";
			$file_toCopy = $_FILES['pic']['name'];
			$file_fromCopy = $_FILES['pic']['tmp_name'];
			$target_dir .= $file_toCopy;

			if (move_uploaded_file($file_fromCopy,$target_dir)) {
				
				$profile_picture = $target_dir;
			}
		}

	$fname = $con->real_escape_string($fname);
	
 
	$lname = $con->real_escape_string($lname); 

	 $username = strtolower($fname);


	$email = $con->real_escape_string(strtolower($email)); 

	$profile_pic = $profile_picture;

	
	$password = $con->real_escape_string($password);
	$password = md5($password);

$sql = "INSERT INTO `tbluser`(`fname`, `lname`, `gender`,`email`,`profile_pic`,`password`) VALUES ('$fname','$lname','$gender','$email','$profile_pic','$password')";
$result = $con->query($sql);
$user_id = $con->insert_id;

 if($result)
	{
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['user_Id'] = $user_id;
        $_SESSION['profile'] = $profile_pic;
        header("Location: ../Main/index.php");
		/*$a = $con->query("SELECT * FROM `tbluser` WHERE `email` = '$email' ");
		$aa = $a->fetch_assoc();
		
		if($a)
		{
			$aaa = $aa['user_Id'];
			$sql = "INSERT INTO `tblaccount`(`username`, `password`, `user_Id`,`email`) VALUES('$username','$password',$aaa,'$email')";
			$res = $con->query($sql);
			
			if($res==true)
                            {
                                   echo '<script language="javascript">';
                                    echo 'alert("Successfully Registered")';
                                    echo '</script>';
                                    echo '<meta http-equiv="refresh" content="0;url=../index.php" />';
                            }

		}
			*/
		
	}




?>