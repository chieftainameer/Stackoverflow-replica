<?php
  session_start();
 include "../functions/db.php";
  if (isset($_SESSION['uname'])&&$_SESSION['uname']!=""){
  }
  else
  {
    header("Location:index.php");
  }
$uname=$_SESSION['uname'];
$user = $_GET['user'];
$query = "SELECT * FROM `tbluser` WHERE user_Id = $user ";
$result = $con->query($query);
$result = $result->fetch_assoc();
extract($result);

?>
<html>
<head>
	<title></title>

	<!--Custom CSS-->
	<link rel="stylesheet" type="text/css" href="../css/global.css">
	<!--Bootstrap CSS-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!--Script-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            background-color: #e7eae5;
        }
    </style>
</head>
<body>
	<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="home.php"></a>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">Administrator</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="home.php"> Dashboard</a></li>
                    <li><a href="questions.php"> Questions</a></li>
                    <li class="active"><a href="user.php"> Users</a></li>
                </ul>
   <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" ><span class="glyphicon glyphicon-user"></span> <?php echo $uname;?></a></li>
                <li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
               
                </ul>   
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div class="container" style="margin:8% auto;">
    <div class="row" style="text-align: center;">
        <div class="col-md-12 img">
            <img src="<?= $profile_pic ?>" alt="Profile Picture" style="width: 300px;height:300px;border-radius: 50%;" title="click to update">
        </div>
    </div>

    <div class="row name" style="margin-top: 15px;text-align: center;">
        <div class="col-md-6">
            <label>First Name</label>
            <h3><?= $fname ?></h3>
        </div>
        <div class="col-md-6">
            <label>Last Name</label>
            <h3><?= $lname ?></h3>
        </div>
    </div>
    <div class="row name" style="margin-top: 15px;text-align: center;">
        <div class="col-md-6">
            <label>Email</label>
            <h3><?= $email ?></h3>
        </div>
        <div class="col-md-6">
          <label>Gender</label>
          <h3><?= $gender ?></h3>
        </div>
    </div>
    <div class="row" style="text-align: center;margin-top: 15px;">
        <div class="col-md-12">
            <a class="btn btn-danger" href="delete_user.php?user=<?= $user ?>">Delete</a>
        </div>
    </div>

</div>


</body>
</html>