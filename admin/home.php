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
                    <li class="active"><a href="home.php"> Dashboard</a></li>
                    <li><a href="questions.php"> Questions</a></li>
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

    <?php if(isset($_SESSION['deleted'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success </strong><?= $_SESSION['deleted']; ?>
            </div>
    <?php unset($_SESSION['deleted']);
        endif; 
        ?>

        <?php if(isset($_SESSION['error_deleting'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error </strong><?= $_SESSION['error_deleting']; ?>
            </div>
    <?php unset($_SESSION['error_deleting']);
        endif; 
        ?>

        <div class="container" style="margin:8% auto;width:900px;">

                 <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Questions Posted</h3>
                </div> 
                 <div class="panel-body">
            <table class="table table-stripped">
                                <th>Title</th>
                                <th>Tags</th>
                                <th>Action</th>
                            <?php
                            
                            include "../functions/db.php";

                            $sql = "SELECT * FROM questions  ORDER BY `question_id` DESC LIMIT 10";
                            $run = $con->query($sql);

                            while($row=$run->fetch_assoc())
                            {
                                $id = $row['question_id'];
                                echo "<tr>";
                                echo "<td>".$row['title']."</td>";
                                echo "<td>".$row['tags']."</td>";
                                 echo "<td>".
                                    "<a href='question_detail.php?question=$id' class='btn btn-default'>Details</a>"
                                    ."</td>";
                                    echo "<td>".
                                    "<a href='delete_question.php?question=$id' class='btn btn-danger'>Delete</a>"
                                    ."</td>";
                                echo "</tr>";
                            }
                           

                            ?>
                            </table>
                     </div>
                </div><!-- panel ends here -->

                <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Recent User Accounts</h3>
                </div> 
                 <div class="panel-body">
            <table class="table table-stripped">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            <?php
                            
                            include "../functions/db.php";

                            $sql = "SELECT * FROM tbluser  ORDER BY `user_Id` DESC LIMIT 10";
                            $run = $con->query($sql);

                            while($row=$run->fetch_assoc())
                            {
                                $id = $row['user_Id'];
                                echo "<tr>";
                                echo "<td>".$row['fname']."</td>";
                                echo "<td>".$row['lname']."</td>";
                                echo "<td>".$row['email']."</td>";
                                 echo "<td>".
                                    "<a href='user_detail.php?user=$id' class='btn btn-default'>Details</a>"
                                    ."</td>";
                                    echo "<td>".
                                    "<a href='delete_user.php?user=$id' class='btn btn-danger'>Delete</a>"
                                    ."</td>";
                                echo "</tr>";
                            }
                           

                            ?>
                            </table>
                     </div>
                </div><!-- panel ends here -->


            </div>
	</body>
</html