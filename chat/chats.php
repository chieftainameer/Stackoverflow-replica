<?php

session_start();
include '../functions/db.php';
if (!isset($_SESSION['username'])) {
	header('location:../Main/index.php');
	$_SESSION['login_require'] = "Please Log in to access this page";
}
$current_user = $_SESSION['user_Id'];
$username = $_SESSION['username'];
$lastname = $_SESSION['lname'];
$profile = $_SESSION['profile'];
$query = "SELECT * FROM `chats` WHERE sender_id = $current_user OR receiver_id = $current_user";
$chat_result = $con->query($query);
$chatting_id;
$othr_user;
if ($chat_result->num_rows < 1) {
	echo "No chats";
}
function other_user($current_user,$sender,$receiver){
	if ($current_user != $sender) {
		return  $sender;

	}
	else
	{
		return $receiver;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/global.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<title>NCBA&E-Sharing Knowledge</title>

	<style type="text/css">
		#side-bar-div{
			position:fixed;
			left: 0;
			top: 0;
			width: 25%;
			height: 100%;
			box-sizing: border-box;
			background-color: grey;

		}
		#messages-div{
			position:fixed;
			left: 25%;
			top: 0;
			width: 75%;
			height: 100%;
			box-sizing: border-box;
			background-color: #e7eae5;
			background:url(../images/backg.jpg);
		}
		#my-header{
			position: fixed;
			top: 0;
			left: 0;
			width: 25%;
			height: 70px;
			background-color: maroon;
-			display: inline-block;
		}
		#my-header img{
			height: 50px;
			width: 50px;
			border-radius: 50%;
			margin-top: 10px;
			margin-left: 7px;
		}
		#my-header h4{
			margin-left: 65px;
			margin-top: -40px;
		}

		#each-chat{
			margin-top: 15px;
			padding:15px;
			margin-left: 15px;
			margin-right: 15px;
			background-color: white;
			border-radius: 25px;
			box-sizing: border-box;
		}
		#chats{
			margin-top:80px;
			overflow-y: scroll;
			height: 580px;
			margin-bottom: 60px;
		}
		#his-message{
			padding: 15px;
			margin-top: 10px;
			background-color: #ffffff;
			margin-right: 50%;
			border-radius: 25px;
		}
		#my-message{
			padding: 15px;
			margin-top: 10px;
			border-radius: 25px;
			margin-left: 50%;
			background-color: #dcf8c6;
		}
		.message-send-section{
			position: fixed;
			bottom: 0;
			width: 100%;
			background-color: white;
			height: 55px;
			padding-top: 15px;
		}
		#messages-div{
			overflow-y: scroll;
		}
		.chat-section{
			margin-bottom: 55px;
		}
	</style>
</head>
<body>
<div id="side-bar-div">
	<div id="my-header">
		<img src="<?= $profile ?>">
		<h4><?= $username." ".$lastname ?></h4>
	</div>
	<div id="chats">
	<?php while($row = $chat_result->fetch_assoc()):
	extract($row);
	$other_user = other_user($current_user,$sender_id,$receiver_id);
	$othr_user = $other_user;
	$user = "SELECT * FROM `tbluser` WHERE user_Id = $other_user";
	$result_user = $con->query($user);
	$result_user = $result_user->fetch_assoc();
	extract($result_user);
	?>
	  <div id="each-chat" onclick="renderMessages(<?= $user_Id ?>,<?= $chat_id ?>)">
		<img src="<?= $profile_pic ?>" style="height:50px;width:50px;"><span style="padding-left:10px;" ><?= $fname." ".$lname ?></span>
		<p>hello</p>
	  </div>
    <?php endwhile;  ?>
   </div>
</div>
<div id="messages-div">
	<div class="chat-section">
		
	</div>
	<div class="message-send-section">
		<input type="text" name="input-message" id="message-field" class="form-control" placeholder="Enter Your Message Here">
	</div>
</div>


<script type="text/javascript">
	function renderMessages(other_user,chat_id){
		//alert(other_user+" "+chat_id);
		$.ajax({
			url:'retrieve_messages.php',
			type:'POST',
			data:{other:other_user,chat:chat_id},
			success:function(response){
				$(".chat-section").empty();
				$(".chat-section").append(response);
				$("#messages-div").scrollTop($(document).height() + 80);
			}
		});
	}
	$("#message-field").on('keyup',function(e){
		let val = $("#message-field").val();
	  if (e.which == 13) {
		createMessage(val);
	  }

	});

	function createMessage(val){
		let chat_id = $("#chat-id-value").val();
		let other_user = $("#chat-id-value").data('other');
		$.ajax({
			url:'create_message.php',
			type:'POST',
			data:{other:other_user,chat_id:chat_id,val:val},
			success:function(response){
				$("#message-field").val(" ");
				$(".chat-section").append(response);
				$("#messages-div").scrollTop($(document).height() + 80);
				//alert(response);
			}
		});
	}
		/*let a = 2;
	$("#messages-div").on('scroll',function(){
		let msg = $("#messages-div").scrollTop();
	
	 if (msg === 0) {
		let chat_id = $("#chat-id-value").val();
	 	prependMessage(a,chat_id);
	 	a = a + 1;
	 }
	});

	function prependMessage(page,chat_id){
		$.ajax({
			url:'prepend_messages.php',
			type:"POST",
			data:{page:page,chat_id:chat_id},
			success:function(response){
				$(".chat-section").prepend(response);
				$("#messages-div").scrollTop = 200;
			}
		});
	}*/
</script>
</body>
</html>


























