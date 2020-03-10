<?php


function dbcon(){
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$db = "dbforum";

	$con = new mysqli($host,$user,$pwd,$dbname) or die ("ERROR Connecting to Database");

	
}

function dbclose(){
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$db = "dbforum";

	$con = new mysqli($host,$user,$pwd,$dbname) or die ("ERROR Connecting to Database");

	$con>close();
}

function deleteuser($user_Id){
	dbcon();
	$sel = $con->query("DELETE from tbluser where user_Id='$user_Id' ");

	if($sel==true){
		$del = $con->query("DELETE from tblacct where user_Id='$user_Id' ");
			echo "success";
		
	}
	else{
		echo "failed";
	}

	dbclose();
}

function category(){
	dbcon();
	$sel = $con->query("SELECT * from category");

	if($sel==true){
		while($row=$sel->fetch_assoc()){
			extract($row);
			echo '<option value='.$cat_id.'>'.$category.'</option>';
		}
	}


	dbclose();
}

?>