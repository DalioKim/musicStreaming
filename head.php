


<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;
    charset=UTF-8" />
<title>로그인 예제</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<!--
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {

        $('#form').on('#btn', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'post.php',
            data: $('#form').serialize(),
            success: function () {
              alert('form was submitted');
            }
          });

        });

      });
    </script>



</head>
-->
<body>
  <!-- navigation -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="main.php">MtG</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="navbar-collapse collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav">
    <li class="active"><a href="free_board.php"> 게시판 <span class="sr-only">(current)</span></a></li>
    <li><a href="dj_ranking.php">Dj순위</a></li>

    <!--음악장르 드롭다운 메뉴-->
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">음악장르<span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="electronic.php">Electronic</a></li>
        <li><a href="reggae.php">reggae</a></li>
        <li><a href="funky.php">funky</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
        <li class="divider"></li>
        <li><a href="#">One more separated link</a></li>
      </ul>
    </li>

    <!--마이 페이지 드롭다운 메뉴-->
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">마이페이지<span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="my_music.php">my music</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
        <li class="divider"></li>
        <li><a href="#">One more separated link</a></li>
      </ul>
    </li>

    <!--관리자 페이지-->

        </ul>





        <!-- 검색창 부분 -->

        <ul class="nav navbar-nav navbar-right">


        <!--로그인 여부에 따른 로그인 버튼과 로그아웃 버튼 --->
        <?php if(empty($user_id)){?>
          <li class="list-inline-item"> <a href="login.php" >로그인</a> </li>
        <?php }else if(!empty($user_id)){?>
          <li class="list-inline-item"> <a href="logout.php" >로그아웃</a> </li>


        <?php }?>


    <li><a href="#">Link</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">더보기 <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
      </ul>
    </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
