<?php  

session_start();
include '../functions/db.php';
$current_user = $_SESSION['user_Id'];
$query = "SELECT * FROM `tbluser` WHERE user_Id = $current_user";
$result = $con->query($query);
$result = $result->fetch_assoc();
extract($result);

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
		body{
			background-color: #e7eae5;
		}
		.img{
			text-align: center;
		}
		.name{
			text-align: center;
			margin-top: 50px;
		}
		#camera{
			position: absolute;
			top: 40%;
			left: 49%;
		}
		#profile_pic{
			visibility: hidden;	
		}
	</style>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
  <a class="navbar-brand" href="index.php"><b>NCBA&E</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="index.php"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="questions_page.php"><i class="fas fa-question-circle"></i> Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ask_question.php"><i class="fas fa-pen"></i> Ask Questions</a>
      </li> 
      <?php if(isset($_SESSION['username'])):  ?>
      <li class="nav-item">
        <a class="nav-link" href="../chat/chats.php"><i class="fas fa-sms"></i> Messanger</a>
      </li>   
  <?php endif; ?>
    </ul>
    <ul class="nav navbar-right ml-auto">
        <?php if(isset($_SESSION['user_Id'])):  ?>
        
        <li class="nav-item">
    <div class="dropdown">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
           <img src="<?= $profile_pic ?>" style="width: 25px;height: 25px;">
           <?= $fname ?>
        </button>
         <div class="dropdown-menu">
             <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a>
             <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
       	  </div>
    </div>
     </li>
        <?php else: ?>
        <li class="nav-item"><a href="login_layout.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> signin</a></li>
        <li class="nav-item"><a href="signup_layout.php" class="nav-link"><i class="fas fa-user-plus"></i> signup</a></li>
    <?php endif; ?>
    </ul>
  </div>  
</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-12 img">
			<img src="<?= $profile_pic ?>" alt="Profile Picture" style="width: 300px;height:300px;border-radius: 50%;" title="click to update" onclick="savePic()">
			<div id="camera"><h2><i class="fas fa-camera"></i></h2></div>
		</div>
	</div>
	<form method="post", action="update_picture.php" enctype="multipart/form-data" id="picture-form">
		<input type="file" name="pico" id="profile_pic" onchange="saving(this.value)" />
	</form>
	<div class="row name">
		<div class="col-md-6">
			<label>First Name</label>
			<h5 contenteditable="true" onblur="saveMe(this,'fname')"><?= $fname ?></h5>
		</div>
		<div class="col-md-6">
			<label>Last Name</label>
			<h5 contenteditable="true" onblur="saveMe(this,'lname')"><?= $lname ?></h5>
		</div>
	</div>
	<div class="row name">
		<div class="col-md-6">
			<label>Email</label>
			<h5 onblur="saveMe(this,'email')"><?= $email ?></h5>
		</div>
		<div class="col-md-6">
          <label>Gender</label>
          <h5 contenteditable="true" onblur="saveMe(this,'gender')"><?= $gender ?></h5>
		</div>
	</div>
	<div class="row status" style="text-align: center">
		<div class="col-md-12">
			<p class="btn btn-success">Data Updated</p>
		</div>
	</div>

</div>


<script type="text/javascript">

	function saving(val){
		$("#picture-form").submit();
	}

	$(".status").hide();
	function saveMe(obj,column){
		updateData(obj,column);
	}

	function updateData(obj,column){
		let val = obj.innerHTML;
		$.ajax({
			url:'update_data.php',
			type:'POST',
			data:{value:val,column:column},
			success:function(response){
				$(".status").show();
			}
		});
	}
	function savePic(){
		$("#profile_pic").trigger('click');
	}
	/*function updateMyPic(obj,col){
		alert("file input clicked");
	}*/
	
</script>
</body>
</html>