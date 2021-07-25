<?php
include 'data/db.php';

/*
$user_id = $_SESSION[user_id];

$sql = "SELECT * FROM session WHERE user_id = '{user_id}'";
$ret = mysql_query( $sql );

if( $ret ) {
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> 게시판 </title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap-3.3.2-dist/css/jumbotron.css" rel="stylesheet">
  </head>

  <body>

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
  		<li><a href="#">순위</a></li>
  		<li class="dropdown">
  		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">음악장르<span class="caret"></span></a>
  		  <ul class="dropdown-menu" role="menu">
  		    <li><a href="#">Action</a></li>
  		    <li><a href="#">Another action</a></li>
  		    <li><a href="#">Something else here</a></li>
  		    <li class="divider"></li>
  		    <li><a href="#">Separated link</a></li>
  		    <li class="divider"></li>
  		    <li><a href="#">One more separated link</a></li>
  		  </ul>
  		</li>
  	      </ul>
  	      <form class="navbar-form navbar-left" role="search">
  		<div class="form-group">
  		  <input type="text" class="form-control" placeholder="Search">
  		</div>
  		<button type="submit" class="btn btn-default">Submit</button>
  	      </form>
  	      <ul class="nav navbar-nav navbar-right">
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

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <form class="form-horizontal" method=POST action=write_ok.php>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">제목</label>
              <div class="col-sm-10">
                <input type="text" name=title class="form-control" id="inputEmail3">
              </div>
          </div>
        <label for="inputEmail3" class="col-sm-2 control-label">게시글</label>
        <div class="col-sm-offset-2 col-sm-10">
            <textarea name=body class="form-control" rows="10"></textarea>
        </div>
      </div>
      <label for="inputEmail3" class="col-sm-2 control-label">이미지 미리보기</label>
      <div class="col-sm-offset-2 col-sm-10">
          <textarea name=body class="form-control" rows="10"></textarea>
      </div>
    </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">작성 완료</button>
            </div>
           </div>
         </form>
      </div>
    </div>

    <footer>
      <p>&copy; made 20170823</p>
    </footer>

  </body>
</html>
<?php
/*
}else {
  echo "<script> alert('로그인한 사용자만 글 작성이 가능합니다'); </script>";
?>
  <meta http-equiv='refresh' content="0;url='http://192.168.12.100/index.php'">
<?php
}
*/
?>
