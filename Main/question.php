<?php  
session_start();
if (isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
   $profile = $_SESSION['profile'];
	
}
include '../functions/db.php';
$question_id = $_GET['question'];
//echo $question_id;
$query = "SELECT * FROM `questions` WHERE question_id = $question_id";
$question_result = $con->query($query);
$question_result = $question_result->fetch_assoc();
extract($question_result);
$result_recent = $con->query("SELECT * FROM `questions` ORDER BY question_id DESC LIMIT 12");

$total_ans = $con->query("SELECT COUNT(*) AS total_ans FROM `answers` WHERE question_id = $question_id ");
$total_ans = $total_ans->fetch_assoc();
$total_ans = $total_ans['total_ans'];


$answer_result = $con->query("SELECT * FROM `answers` WHERE question_id = $question_id ");


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
		.taggo{
		background-color: #95C8D8;
		display:inline-block;
		max-width: 150px;
		margin-right: 5px;
		border-radius: 5px;
		padding: 5px;
	}
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
        .question-left{
        	padding: 25px;
        	text-align: center;
        	border-right: 1px solid black;
        	height: 100%;
        }
        #left-ul{
        	list-style: none;
        }
        #left-ul li{
        	border-radius: 40px;
        	padding: 5px;
        	margin-left: 5px;
        	margin-right: 5px;
        }
        #left-ul li a{
        	color:black;
        }
        #left-ul li:hover{
        	background-color:silver;
        	border-radius:0;
        	transition: 1s;
        }
        #left-ul li a:hover{
        	text-decoration: none;
        }
        #tags{
        	background-color: #f5f5f5;
        	padding: 15px;
        }
        .by-tag:hover{
        	background-color: #f5f5f5;
        	opacity: 0.3;
        	cursor: pointer;
        }
        .by-tag a{
        	color: black;
        }
        .by-tag a:hover{
        	text-decoration: none;
        }
        .question-center{
        	padding: 25px;
        }
        #question-center{
        	margin-bottom: 25px;
        }
        .ask-quest{
        	text-align: right;
        }
        .question{
        	border-bottom: 1px solid grey;
        	padding: 20px;
        }
        .question a:hover{
        	text-decoration: none;
        }
        .right-panel{
        	margin-top: 15px;
        }
        .content{
        	background-color: #efdecd;
        	padding: 5px;
        	border-bottom: 1px solid #FFF8DC;
        }

        .content:hover{
        	background-color: #f5deb3;
        }
        .content a{
        	color:black;
        }
        .content a:hover{
        	text-decoration: none;
        	color:blue;
        }
        #answer{
        	background-color: #f5f5f5;
        	padding: 30px;
        	margin-top: 20px;
        }
        #answer-form{
        	margin-top: 35px;
        }
        .menu{
            text-align: center;
            color:grey;
        }
        .policy{
            text-align: center;
            color:grey;
        }.rights{
            text-align: center;
            color: grey;
        }
        footer{
            background-color: #262b2f;
            padding-bottom: 20px;
            padding-top: 20px;  
        }
        .footer-menu{
            list-style: none;
        }
        .rights ul{
            list-style: none;
        }
        .policy ul{
            list-style: none;
        }
        .rights ul li a{
            color: grey;
        }
        .policy ul li a{
            color: grey;
        }
        .rights ul li a:hover{
            color: blue;
            text-decoration: none;
        }
        .policy ul li a:hover{
            color: blue;
            text-decoration: none;
        }
        .footer-menu li a{
            color:grey;
        }
        .footer-menu li a:hover{
            color:blue;
            text-decoration: none;
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
        <a class="nav-link active" href="questions_page.php"><i class="fas fa-question-circle"></i> Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="ask_question.php"><i class="fas fa-pen"></i> Ask Questions</a>
      </li> 
      <?php if(isset($_SESSION['username'])): ?>
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
        <li class="nav-item"><a href="login_layout.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> signin</a></li>
        <li class="nav-item"><a href="signup_layout.php" class="nav-link"><i class="fas fa-user-plus"></i> signup</a></li>
    <?php endif; ?>
    </ul>
  </div>  
</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 question-left">
			<p style="font-weight: bold;"><i class="fab fa-chrome"></i> NCBA&E</p>
			<ul id="left-ul">
				<li><a href="users.php"><i class="fas fa-user"></i> Users</a></li>
			</ul>
			<p style="font-weight: bold;">Search Questions by Tags</p>

			<div id="tags">
				<h6>Quick selection</h6>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('html')"><p>HTML</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('php')"><p>PHP</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('css')"><p>CSS</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('laravel')"><p>LARAVEL</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('python')"><p>PYTHON</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('android')"><p>ANDROID</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('javascript')"><p>JAVASCRIPT</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('java')"><p>JAVA</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('c++')"><p>C++</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('pandas')"><p>PANDAS</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('matplotlib')"><p>MATPLOTLIB</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('data')"><p>DATA</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('pycharm')"><p>PYCHARM</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('rails')"><p>RAILS</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('ruby')"><p>RUBY</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 by-tag" onclick="fetchMeData('ecma')"><p>ECMA</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('jquery')"><p>JQUERY</p></div>
					<div class="col-md-4 by-tag" onclick="fetchMeData('vue')"><p>VUE.JS</p></div>
				</div>
				<!-- <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="search-by-tag" id="by-tag" placeholder="Enter tag you are looking for" class="form-control">
						</div>
					</div>
				</div> -->
			</div>
		</div>

		<div class="col-md-9 question-center">
			<div class="row" id="question-center">
				<div class="col-md-8 top-quest">
					<h4><?= $title ?></h4>
				</div>
				<div class="col-md-3 ask-quest">
					<a href="ask_question.php"><button class="btn btn-primary">Ask Question</button></a>
				</div>
			</div>
			<hr/>
			<div id="question-data">
			<?php 
				$tag_arr = explode(',', $tags);
				$length = sizeof($tag_arr);
				?>
				<div class="row">
				<div class="col-md-7">
			    <div class="row question">
				<div class="col-md-12">
					<p><?= $description ?></p>
					<input type="hidden" name="question-id" id="question-id" value="<?= $question_id ?>">
					<?php for($i = 0;$i < $length; $i++): ?>
					<p class="taggo"><?= $tag_arr[$i] ?></p>
					<?php endfor; ?>
				</div>
			    </div>
			    <div id="main-ans">
			    	<h4><?= $total_ans ?> Answers</h4>
			    	<?php while($row = $answer_result->fetch_assoc()): 
			    		extract($row); ?>
			    	<div id="answer">
			    	  <p><?= $content ?></p>
			        </div>
			    <?php endwhile; ?>
			    <?php if(isset($_SESSION['username'])): ?>
			    <div id="answer-form">
			    	<div class="form-group">
			    		<label>Your Answer</label>
			    		<textarea name="answer" id="answer-area" class="form-control" rows="8"></textarea>
			    	</div>
			    	<div class="form-group">
			    		<button class="btn btn-primary" id="answer-submit">Post Your Answer</button>
			    	</div>
			    </div>
			<?php endif; ?>
			    </div>
			    </div>
			<div class="col-md-4 offset-md-1 right-panel">
				<h5>Recent Questions</h5>
				<?php while($row = $result_recent->fetch_assoc()): 
					$tag_arr = explode(',', $row['tags']);
					extract($row);
					?>
				<div class="row content">
					<div class="col-md-12">
						<p><a href="question.php?question=<?= $question_id ?>" onclick="fetchMeData('<?= $tag_arr[0] ?>')" ><?= $title ?></a></p>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>

	        </div>
		</div>

		</div><!-- row div ends here -->
		 <footer>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-4 menu">
            <h4>First Menu</h4>
            <ul class="footer-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="questions_page.php">Questions</a></li>
                <li><a href="ask_question.php">Ask Question</a></li>
            </ul>
        </div>
        <div class="col-md-4 rights">
        <h4>Messenger</h4>
        <ul>
            <li><a href="../chat/chats.php">Open Messenger</a></li>
        </ul>
    </div>
        <div class="col-md-4 policy">
            <h4>Policy</h4>
            <ul>
            <li><a href="">Priavcy Policy</a></li>
            <li><a href="">Terms & Conditions</a></li>
        </ul>
        </div>
    </div>
</div>
</footer>
		</div><!-- container-fluid div ends here -->


<script type="text/javascript">

	$("#by-tag").on("keyup",function(event){
		let val = $("#by-tag").val();
		if (event.which == 13) {
			fetchMeData(val);
		}
	});

	function fetchMeData(tag){
		
		$.ajax({
			url: 'bytag.php',
			type: 'POST',
			data:{tags:tag},
			success:function(response){
				$("#question-data").empty();
				$("#question-data").append(response);
			}
		});
	}

	$("#answer-submit").on('click',function(){
		let content_data = $("#answer-area").val();
		let id = $("#question-id").val();
		if ($("#answer-area").val() == "") {
			alert("kindly provide atleast 10 words");
		}
        else
        {
		$.ajax({
			url: 'submit_answer.php',
			type: "POST",
			data:{question_id:id,content:content_data},
			success:function(res){
				showData(res);
			},
		});
    }
	});
	function showData(data){
		$("#main-ans").append(data);
	}
</script>
</body>
</html>


















