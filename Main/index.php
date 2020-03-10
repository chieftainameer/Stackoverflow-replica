<?php
  session_start();
  if(isset($_SESSION['username'])){
$username=$_SESSION['username'];
$userid = $_SESSION['user_Id'];
$profile = $_SESSION['profile'];
}
?>
<html>
<head>
	<title></title>

	<!--Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../css/global.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        body{
        background-color: #e7eae5;
    }
        #header-div{
            margin-top: 40px;
            padding-top: 50px;
            height: 700px;
            width: 100%;
            background-image: url(../images/white.jpg);
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }
        #header-text{
            position: absolute;
            top: 35%;
            left: 23%;
            background-color: white;
            opacity: 0.8;
            text-align: center;
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
        .footer{
            background-color: black;
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
        .cards{
            margin-top: 30px;
            text-align: center;
        }
        #card-img{
            padding: 5px;
        }
        #card:hover{
            box-shadow: 5px 5px 2px grey;
        }
        .card-second{
            margin-top: -15px;
        }
        .home-content{
            margin-top: 35px;
            margin-bottom: 35px;
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
	<!-- Navigation -->

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
    <?php if(isset($_SESSION['login_require'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error </strong><?= $_SESSION['login_require']; ?>
            </div>
    <?php unset($_SESSION['login_require']);
        endif; 
        ?>
    <div id="header-div" class="img-responsive">
        <div id="header-text">
            <h1>Hello NCBA&E Students</h1>
            <p>This forum is particulary for NCBA&E student where they can come discuss and find answers of their thoughts</p>
            <p>Lets Grow Together</p>
            <a href="ask_question.php"><button class="btn btn-info">Ask Questions</button></a>
            <a href="questions_page.php"><button class="btn btn-info">Find Answers</button></a>
        </div>
    </div>
    <div class="cards">
    <div class="container">
        <div class="row">
            <div class="col-md-4"> 
                <div class="card" id="card">
                    <img class="card-img-top" src="../images/web.png" alt="card image" id="card-img">
                    <div class="card-body">
                        <h4 class="card-title">Ask Questions</h4>
                        <p class="card-text">in this forum you can ask questions you find related to your studies and about any problem in university.other fellows will help you to get over this</p>
                        <a href="ask_question.php"><button class="btn btn-primary">Ask Questions</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="card card-second" id="card">
                    <img class="card-img-top" src="../images/start.png" alt="card image" id="card-img">
                    <div class="card-body">
                        <h4 class="card-title">Private Q&A</h4>
                        <p class="card-text">You can contact the right person you think can answer your question in private message section.this is one to one conversation section</p>
                        <a href="../chat/chats.php"><button class="btn btn-primary">Private Q&A</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"> 
                <div class="card" id="card">
                    <img class="card-img-top" src="../images/web.png" alt="card image" id="card-img">
                    <div class="card-body">
                        <h4 class="card-title">Browse Questions</h4>
                        <p class="card-text">Go to browse question page to answer the questions and help other fellow students to comprehend the concept and let them keep growing</p>
                        <a href="questions_page.php"><button class="btn btn-primary">Browse Questions</button></a>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>

        <div class="home-content" >
            <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <h2>Lets help others</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius sodales erat, vitae hendrerit ante maximus non. Praesent suscipit, eros non cursus porttitor, tellus ante tempor quam, in blandit urna purus ut ex. Donec ultrices, ipsum nec fermentum convallis, nunc est sollicitudin diam, id maximus odio enim at dolor. Sed neque nisi, hendrerit vel massa id, commodo commodo urna. Integer diam nulla, molestie a porta id, hendrerit in metus. Donec scelerisque sodales purus, a aliquet neque placerat sit amet. Praesent blandit ullamcorper rhoncus. Cras sit amet dolor imperdiet, imperdiet dui at, venenatis tellus. Nunc quis pretium dui. Integer ut varius mauris. Donec vulputate ipsum eget urna blandit, id ultrices augue consequat. In eget rutrum dolor, in fringilla neque.

                    Quisque massa nisi, cursus non luctus ac, blandit at metus. Cras facilisis enim magna, ac consectetur nibh pretium feugiat. Aliquam sit amet tortor urna. In hac habitasse platea dictumst. Sed fermentum dui eget orci euismod malesuada. Nunc risus nulla, dignissim non accumsan sed, lacinia nec ipsum. Donec nec purus dui. Mauris pretium blandit rutrum. Integer posuere dui vel pellentesque tempus. Praesent eget feugiat ligula. Nunc eu nisl viverra, fermentum lectus vel, vehicula quam. Maecenas ullamcorper nisl nec nisi fermentum, sed tempus risus tincidunt.</p>
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


</body>
</html>