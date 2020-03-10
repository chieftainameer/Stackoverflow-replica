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
$question = $_GET['question'];
$query = "SELECT * FROM `questions` WHERE question_id = $question ";
$result = $con->query($query);
$result = $result->fetch_assoc();
extract($result);
$ans = "SELECT * FROM `answers` WHERE question_id = $question ";
$any_record = 0;
$ans_result = $con->query($ans);
if ($ans_result->num_rows > 0) {
    $any_record = 1;
}
$tag_arr = explode(',', $tags);
$length = sizeof($tag_arr);
$count = "SELECT COUNT(*) AS total FROM `answers` WHERE question_id = $question ";
$tot_res = $con->query($count);
if ($tot_res->num_rows > 0) {
   $total_ans = $tot_res->fetch_assoc();
   $total_ans = $total_ans['total'];
}
else
{
    $total_ans = 0;
}

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
            .taggo{
        background-color: #95C8D8;
        display:inline-block;
        max-width: 150px;
        margin-right: 5px;
        border-radius: 5px;
        padding: 5px;
    }
    #answer{
            background-color: #f5f5f5;
            padding: 30px;
            margin-top: 20px;
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
                    <li class="active"><a href="questions.php"> Questions</a></li>
                    <li><a href="user.php"> Users</a></li>
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
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <h2>Title:</h2>
                    <h3><?= $title ?></h3>
                </div>
                <div class="col-md-4" style="text-align: right;">
                    <a class="btn btn-danger" href="delete_question.php?question=<?= $question ?>">Delete</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Description</h2>
                    <p><?= $description ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php for($i = 0;$i < $length; $i++): ?>
                    <p class="taggo"><?= $tag_arr[$i] ?></p>
                    <?php endfor; ?>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <h3><?= $total_ans ?> Answers</h3>
                </div>
            </div>
            <?php if($any_record == 1):
                while($row = $ans_result->fetch_assoc()):
                    extract($row);
             ?>
             <div class="row">
                 <div class="col-md-12">
                    <div id="answer">
                     <p><?= $content ?></p>
                 </div>
                 </div>
             </div>

            <?php endwhile;
                endif;
             ?>
        </div>
    </div>
</div>
</body>
</html>