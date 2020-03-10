<?php  
session_start();
if (!isset($_SESSION['username'])) {
 header('location:index.php');
  $_SESSION['login_require'] = "Please Log in to access this page";
}
include '../functions/db.php';
if (isset($_SESSION['username'])) {
$username = $_SESSION['username'];
$profile = $_SESSION['profile'];
$current_user = $_SESSION['user_Id'];
}

$query = "SELECT * FROM `tbluser` WHERE user_Id <> $current_user ";
$result = $con->query($query);
if($result->num_rows > 0){
  $any_user = 1;
}
else
{
  $any_user = 0;
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
		body{
		background-color: #e7eae5;
	}
	 li.nav-item{
        	font-weight: bold;
        }
        li.nav-item:hover{
        	background-color: silver;
        	border-radius: 50px;
        	transition: 1s;
        }
        li.nav-item a:hover{
        	color: black;
        }
        #left-ul{
          list-style: none;
        }
        #left-ul li{
          margin-top: 15px;
          
        }
        #left-ul li:hover{
          border-radius: 30px;
          background-color: grey;
          transition: 2s;
        }
        #left-ul li a{
          color: black;
        }
        #left-ul li a:hover{
          color: black;
          text-decoration: none;
        }
        #side-bar{
          padding:25px;
          text-align: center;
          border-right: 1px solid black;
        }
        #user-area{
          padding-top: 25px;
          padding-left: 30px;
        }
        #search{
          border-radius: 10px;
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
        <a class="nav-link " href="index.php"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="questions_page.php"><i class="fas fa-question-circle"></i> Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="ask_question.php"><i class="fas fa-sms"></i> Ask Questions</a>
      </li>    
    </ul>
    <ul class="nav navbar-right ml-auto">
         <?php if(isset($_SESSION['user_Id'])):  ?>
        
        <li class="nav-item">
    <div class="dropdown">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
           <img src="<?= $profile ?>" style="width: 25px;height: 25px;">
           <?= $username ?>
        </button>
         <div class="dropdown-menu">
             <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a>
             <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
         </div>
    </div>
     </li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link"><i class="fas fa-sign-in-alt"></i> signin</a></li>
        <li class="nav-item"><a class="nav-link"><i class="fas fa-user-plus"></i> signup</a></li>
    <?php endif; ?>
    </ul>
  </div>  
</div>
</nav>

<div class="container">
<div class="jumbotron" style="text-align: center;margin-top: 20px;">
  <h1>NCBA&E Forum</h1>
  <p>Lets help each other and grow together</p>
</div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 fixed-left" id="side-bar">
      <p style="font-weight: bold;"><i class="fab fa-chrome"></i> NCBA&E</p>
      <ul id="left-ul">
        <li><a href="users.php"><i class="fas fa-user active"></i> Users</a></li>
      </ul>
    </div>
    <div class="col-md-8" id="user-area">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
        <input type="text" name="search" id="search">
      </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row search-user">
            
            <?php if($any_user == 1): 
              while($row = $result->fetch_assoc()):
              extract($row);
              $if_any = $con->query("SELECT * FROM chats WHERE (sender_id = $current_user AND receiver_id = $user_Id) OR (sender_id = $user_Id AND receiver_id = $current_user)");
             ?>
             <div class="col-md-3" style="text-align: center;">
              <div class="card" style="width:100%;margin-top: 15px;">
                <img class="card-img-top" src="<?= $profile_pic ?>" alt="Card image" style="height: 160px;width: 100%;">
                <div class="card-body">
                  <h4 class="card-title"><?= $fname ?></h4>
                  <input type="hidden" name="other-user" id="other-user">
                  <p class="card-text">Some example text.</p>
                  <?php if($if_any->num_rows > 0): ?>
                  <button  class="btn btn-primary">Already Added</button>
                  <?php else: ?>
                  <button  class="btn btn-primary" value="<?= $user_Id  ?>" onclick="execu(this.value)" >Start Chat</button>
                <?php endif; ?>
                </div>
              </div>
           </div>
           <?php endwhile;?>
           <?php else: ?>
           <div>
             <h2>No Users Found</h2>
           </div>
         <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function execu(val){
    //event.preventDefault();
    addToChat(val);
  }

  function addToChat(other_user){
    $.ajax({
      url: 'add_to_chat.php',
      type:'POST',
      data:{other:other_user},
      success:function(response){
        window.location.replace('../chat/chats.php');
      }
    });
  }

  $("#search").on('keyup',function(e){
    if (e.which == 13) {
        retreiveUsers();
    }
  });

  function retreiveUsers(){
    let val = $("#search").val();
    $.ajax({
      url:'retreive_users.php',
      type:'POST',
      data:{val:val},
      success:function(response){
        //alert(response);
        $(".search-user").empty();
        $(".search-user").append(response);
      }
    });
  }
</script>
</body>
</html>





















