<?php
include('data/db.php');
session_start();


//세션으로 회원가입창에서 입력된 값을 넘겨받는다.
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$email = $_SESSION['email'];
//이메일 인증에 사용할 난수
$rand_num = $_SESSION['rand_num'];

if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
{
  $rand=$_POST['rand'];

  if($rand_num == $rand){


   mysqli_query($db,"UPDATE users SET activate='1' WHERE username='$username'");
   $_SESSION['username'] = $username;
   header("Location: main.php");



  }else{
  }


}


 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
     <title> 인증번호 확인 </title>

     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">

</head>

<body>
  <div>
    <h1> 이메일 인증을 하셔야만 회원이 활성화됩니다.</h1>



    <form id="form" method="post" enctype="multipart/form-data" class="form-horizontal" style="margin: 0 300px 0 300px;border: solid 1px;border-radius:4px">
    	<table class="table table-responsive">


        <tr>
        	<td><label class="control-label">인증번호</label></td>
            <td><input class="form-control" type="text" name="rand" placeholder="인증번호를 입력하세요" autocomplete="off" readonly
        onfocus="this.removeAttribute('readonly');" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
             <button type="submit" name="submit"  class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp; 인증확인</button>
            </td>
        </tr>
        </table>
    </form>


</div>
</body>
