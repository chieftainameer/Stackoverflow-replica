<?php  

session_start();
include '../functions/db.php';
$current_user = $_SESSION['user_Id'];
extract($_POST);
$query = "SELECT * FROM `tbluser` WHERE fname LIKE '%$val%' OR lname LIKE '%$val%' ";
$result = $con->query($query);
$output = '';
while ($row = $result->fetch_assoc()) {
	extract($row);
	$user_query = "SELECT * FROM `chats` WHERE (sender_id = $current_user AND receiver_id = $user_Id) OR (sender_id = $user_Id AND receiver_id = $current_user) ";
	$user_res = $con->query($user_query);

	$output .= '<div class="col-md-3" style="text-align: center;">
              <div class="card" style="width:100%;margin-top: 15px;">
                <img class="card-img-top" src="'. $profile_pic.'" alt="Card image" style="height: 160px;width: 100%;">
                <div class="card-body">
                  <h4 class="card-title">'.$fname.'</h4>
                  <input type="hidden" name="other-user" id="other-user">
                  <p class="card-text">Some example text.</p>';
                  if ($user_res->num_rows > 0) {
                  $output .= '<button  class="btn btn-primary">Already Added</button>';
                  }
                  else{
                  $output .= '<button  class="btn btn-primary" value="'. $user_Id.'" onclick="execu(this.value)" >Start Chat</button>';
                  }
                $output .= '</div>
              </div>
           </div>';
}
echo $output;

?>