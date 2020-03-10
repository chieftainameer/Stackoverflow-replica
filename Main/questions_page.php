<?php  
session_start();
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$profile = $_SESSION['profile'];
$current_user_id = $_SESSION['user_Id'];
//echo $current_user_id;
}
include "../functions/db.php";
$result = $con->query("SELECT * FROM `questions` LIMIT 5 ");
$result_recent = $con->query("SELECT * FROM `questions` ORDER BY question_id DESC LIMIT 12");
$tot_q = "SELECT COUNT(*) AS TOTAL FROM `questions`";
$tot_exec = $con->query($tot_q);
if($tot_exec->num_rows > 0){
$tot_res = $tot_exec->fetch_assoc();
$tot_res = $tot_res['TOTAL'];
}
else
{
    $tot_res = 0;
}

/*$text = "The link you gave is a function to find the last white space after chopping text to a desired length so you don't cut off in the middle of a word. However, it is missing one important thing - the desired length to be passed to the function instead of always assuming you want it to be 25 characters. So here's the updated version:";
echo substr($text,0,250);
$arr = ["php","html","css","python"];
for ($i=0; $i < sizeof($arr) ; $i++) { 
	echo "<p class='taggo'>".$arr[$i]."</p>";
}*/

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
</head>
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
        .question-right{
        	padding: 20px;
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
<?php if(isset($_SESSION['updated'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success </strong><?= $_SESSION['updated']; ?>
            </div>
    <?php unset($_SESSION['updated']);
        endif; 
        ?>

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
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('html')"><p>HTML</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('php')"><p>PHP</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('css')"><p>CSS</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('laravel')"><p>LARAVEL</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('python')"><p>PYTHON</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('android')"><p>ANDROID</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2 by-tag" onclick="fetchMeData('javascript')"><p>JAVASCRIPT</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('java')"><p>JAVA</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('c++')"><p>C++</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2 by-tag" onclick="fetchMeData('pandas')"><p>PANDAS</p></div>
					<div class="col-md-4 col-sm-2 by-tag" onclick="fetchMeData('matplotlib')"><p>MATPLOTLIB</p></div>
					<div class="col-md-4 col-sm-2 by-tag" onclick="fetchMeData('data')"><p>DATA</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('pycharm')"><p>PYCHARM</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('rails')"><p>RAILS</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('ruby')"><p>RUBY</p></div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('ecma')"><p>ECMA</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('jquery')"><p>JQUERY</p></div>
					<div class="col-md-4 col-sm-2  by-tag" onclick="fetchMeData('vue')"><p>VUE.JS</p></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="search-by-tag" id="by-tag" placeholder="Enter tag you are looking for" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 question-center">
			<div class="row" id="question-center">
				<div class="col-md-6 top-quest">
					<h3>Top Questions</h3>
				</div>
				<div class="col-md-6 ask-quest">
					<a href="ask_question.php"><button class="btn btn-primary">Ask Question</button></a>
				</div>
			</div>
			<hr/>
			<div id="question-data">
			<?php while ($row = $result->fetch_assoc()): 
				extract($row);
				$tag_arr = explode(',', $tags);
				$length = sizeof($tag_arr);
				if (strlen($description) > 200) {
					$description = substr($description,0,200)."......";
				}
			
				?>
			<div class="row question">
				<div class="col-md-12">
					<a href="question.php?question=<?= $question_id ?>">
                       <h4><?= $title ?></h4>
                   </a>
					<p><?= $description ?></p>
					<?php for($i = 0;$i < $length; $i++): ?>
					<p class="taggo"><?= $tag_arr[$i] ?></p>
					<?php endfor; ?>
				</div>
                <?php if(isset($current_user_id)): ?>
                <?php if($user_id == $current_user_id): ?>
                 <div class="row">
                <div class="col-md-2" >
                    <p><a class="btn btn-primary" href="update_question.php?question=<?= $question_id ?>">Update</a></p>
                </div>
                <div class="col-md-2 offset-md-3" >
                    <p><a class="btn btn-danger" href="delete_question.php?question=<?= $question_id ?>">Delete</a></p>
                </div>
                    </div>
              <?php endif; ?>
              <?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
		</div>
		<div class="col-md-3 question-right">
			<h5>Recent Questions</h5>
			<div class="content-main">
				<?php while($row = $result_recent->fetch_assoc()): 
					extract($row);
					?>
				<div class="row content">
					<div class="col-md-12">
						<p><a href="question.php?question=<?= $question_id ?>"><?= $title ?></a></p>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</div>

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

</div>


<script type="text/javascript">

	$("#by-tag").on("keyup",function(event){
		let val = $("#by-tag").val().toLowerCase();
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
</script>
<?php if($tot_res > 5): ?>
<script type="text/javascript">
var isEmpty = false;
	let a = 2;
	$(window).scroll(function(){
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			fetchMoreData(a);
			a = a + 1;
			//alert(a);
		}
	});

	function fetchMoreData(page){
		$.ajax({
			url: 'more_data.php',
			type: 'POST',
			data:{page:page},
			success:function(response){
                if(response === "No more data"){
                    isEmpty = true;
                }
                if(isEmpty === false){
				$("#question-data").append(response);
            }
			},
		});
	}
</script>
<?php endif; ?>
</body>
</html>





















