<?php  
session_start();
if (!isset($_SESSION['username'])) {
	header('location:index.php');
	$_SESSION['login_require'] = "Please Log in to access this page";
}
$username = $_SESSION['username'];
$profile = $_SESSION['profile'];
if (!isset($_SESSION['user_Id'])) {
	header('location:index.php');
}
include '../functions/db.php';
if($_GET['question']){
$question = $_GET['question'];
$query = "SELECT * FROM `questions` WHERE question_id = $question";
$result = $con->query($query);
$row = $result->fetch_assoc();
extract($row);
}
else
{
  // for no question selected;
}

?>
<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
	<title>Ask Question</title>
</head>
<style type="text/css">
	body{
		background-color: #e7eae5;
	}
	#quest-data{
		text-align: left;
		padding-bottom: 10px;
		margin-top: 20px;
	}
	#question-form{
		background-color: white;	
	}
	#tit-info{
		font-size: 12px;
		margin-top: -7px;
	}
	#form-group{
		padding:20px;
	}
	#question-step{
		margin-top: 20px;
		margin-bottom: 15px;
	}
	#card-step{
		margin-top: 15px;
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
        .card-link{
        	color:black;
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
        <a class="nav-link" href="questions_page.php"><i class="fas fa-question-circle"></i> Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="ask_questions.php"><i class="fas fa-pen"></i> Ask Questions</a>
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
        <li class="nav-item"><a class="nav-link"><i class="fas fa-sign-in-alt"></i> signin</a></li>
        <li class="nav-item"><a class="nav-link"><i class="fas fa-user-plus"></i> signup</a></li>
    <?php endif; ?>
    </ul>
  </div>  
</div>
</nav>

<?php if(isset($_SESSION['update_error'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error </strong><?= $_SESSION['update_error']; ?>
            </div>
    <?php unset($_SESSION['update_error']);
        endif; 
        ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
	<div id="quest-data">
	  <h2>Ask a public  question</h2>
	  </div>
<form method="post" action="update_q.php?question=<?= $question ?>" id="question-form">
	<div class="from-group" id="form-group">
		<label><b>Title</b></label>
		<p id="tit-info"><span>Be specific and imagine you’re asking a question to another person</span></p>
		<input type="text" name="title" id="title" placeholder="e.g is there any function to find the index of element in a php array" class="form-control" value="<?= $title ?>">
	</div>
	<div class="from-group" id="form-group">
		<label><b>Description</b></label>
		<p id="tit-info"><span>include all the information someone need to answer your question</span></p>
		<textarea name="description" id="description" placeholder="Details of your expected and actual results" rows="8" cols="40" class="form-control" ><?= $description ?></textarea>
	</div>
	<div class="from-group" id="form-group">
		<label><b>Tags</b></label>
		<p id="tit-info"><span>add upto 5 tags to describe what your question is about</span></p>
		<input type="text" name="tags" id="tags" class="form-control" placeholder="e.g (php,css,html,java,android etc)" value="<?= $tags ?>">
	</div>
	<div class="from-group" id="form-group">
		<button class="btn btn-primary" id="submit-btn">Update Question</button>
	</div>
</form>
</div>
<div class="col-md-4">
	<div id="question-step">
		<h2>Review Question</h2>
		<div class="card" id="card-step">
			<div class="card-header"><b>Steps</b></div>
			<div class="card-body">
				<p>The community is here to help you with specific coding, algorithm, or language problems.</p><p>

Avoid asking opinion-based questions.</p>
				<div id="accordion">

  <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" href="#collapseOne">
        1-Summarize the problem
      </a>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
        <ul>
        	<li>Include details about your goal</li>
        	<li>Describe expected and actual results</li>
        	<li>Include any error messages</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
        2-Describe what you have tried
      </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Show what you’ve tried and tell us what you found (on this site or elsewhere) and why it didn’t meet your needs. You can get better answers when you provide research
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
        3-Show some code you coded
      </a>
    </div>
    <div id="collapseThree" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Lorem ipsum..
      </div>
    </div>
  </div>

</div>

			</div>
		</div>
	</div>
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
<script type="text/javascript">
	$("#tags").tokenfield({
		autocomplete: {
			source:["php","html","css","javascript","js","java","ruby","ruby on rails","rails","vue.js","vue","angular.js","react,js","typescript","android","ios","programming","c++","c","c#","asp.net","vb.net","python","django","numpy","pandas","ggplot","matplotlib","others"],
			delay:100
		},
		showAutocompleteOnFocus: true
	});
	
	/*$("#submit-btn").on('click',function(e){
		e.preventDefault();
		if ($("#title").val() == "") {
		alert("Please enter title of the question");
	    }
	    else if ($("#description").val() == "")	 {
		alert("Please enter description of the question");
	    }
	    else if ($("#tags").val() == "") {
		alert("Please enter atleast one tag");
	    }
	    else{
		//alert($("#tags").val());
		let form_data = {
			title:$("#title").val(),
			description:$("#description").val(),
			tags:$("#tags").val()
		}
		$.ajax({
			url: 'post_question.php',
			type: 'POST',
			data:form_data,
			beforeSend:function(){
				$("#submit-btn").html("Posting....");
			},
			complete:function(){
				$("#title").val("");
				$("#description").val("");
				$("#tags").val("");
			},
			success:function(response){
				
				$("#submit-btn").html(response);
			}
		});
		}
	});*/
		
</script>
</body>
</html>