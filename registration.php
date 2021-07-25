<?php
  include('data/dbcon.php');
    include('check.php');
    include_once('data/mailer.lib.php');

    //에러 체크
    error_reporting(E_ALL);
    ini_set("display_errors", 1);



   //로그인 여부를 체크하고,

    if (is_login()){
      //회원아이디가 admin이면 관리자 페이지로
        if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin']==1)
            header("Location: admin.php");
            //아니면 일반회원을 환영하는 페이지로 보낸다.
        else
            header("Location: welcome.php");
    }


//패스워드에 대한 정규표현식
//8자보다 길어야 하고 12자보다 짧아야 한다.
function validatePassword($password){
	//Begin basic testing
	if(strlen($password) < 8 || empty($password)) {
		return 0;//Returns 0 if: password is too short (<8 characters) OR doesn't exist.
	}
	if((strlen($password) > 12)) {
		return 0;
	}
	//End basic length tests

	//Begin more advanced testing

  //영문&숫자&특수문자를 포함하고 있어야만 정규표현식의 검사가 통과
	if(preg_match('/[A-Z]/',$password) == (0 || false)){
		return 1;//Returns 1 if: password does NOT contain upper case letters
	}
	if(!preg_match('/[\d]/',$password) != (0 || false)){
		return 2;//Returns 2 if: password does NOT contain digits
	}
	if(preg_match('/[\W]/',$password) == (0 || false)){
		return 3;//Returns 3 if: password does NOT contain any special characters
	}
	return true;
}


	//등록이라는 버튼을 클릭해 'post'형식의 요청메소드가 호출되면
        if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
	{

      //입력창 보안관련 메소드
      //아직 파악 못함
      //입력창에 사용자가 입력한 값이 저장되지 않게 하는 처리 같음
        foreach ($_POST as $key => $val)
        {
            if(preg_match('#^__autocomplete_fix_#', $key) === 1){
                $n = substr($key, 19);
                if(isset($_POST[$n])) {
                    $_POST[$val] = $_POST[$n];
            }
        }
        }

    $username=$_POST['newusername'];
		$password=$_POST['newpassword'];
		$confirmpassword=$_POST['newconfirmpassword'];
    $email=$_POST['email'];



             //   if (!validatePassword($password)){
	//		$errMSG = "잘못된 패스워드";
          //      }

                if ($_POST['newpassword'] != $_POST['newconfirmpassword']) {
                        $errMSG = "패스워드가 일치하지 않습니다.";
                }

		if(empty($username)){
			$errMSG = "아이디를 입력하세요.";
		}
		else if(empty($password)){
			$errMSG = "패스워드를 입력하세요.";
		}
		else if(empty($email)){
			$errMSG = "이메일을 입력하세요.";
		}

                //아이디 중복검사
                try {
                    $stmt = $con->prepare('select * from users where username=:username');
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();

               } catch(PDOException $e) {
                    die("Database error: " . $e->getMessage());
               }

               $row = $stmt->fetch();
               if ($row){
                    $errMSG = "이미 존재하는 아이디입니다.";
               }


    //db에 회원정보 저장하는 부분
		if(!isset($errMSG))
		{
                   try{
			$stmt = $con->prepare('INSERT INTO users(username, password, email, salt) VALUES(:username, :password, :email, :salt)');
			$stmt->bindParam(':username',$username);
                        $salt = bin2hex(openssl_random_pseudo_bytes(32));
                        $encrypted_password = base64_encode(encrypt($password, $salt));
                        $stmt->bindParam(':password', $encrypted_password);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':salt',$salt);

			if($stmt->execute())
			{
				$successMSG = "새로운 사용자를 추가했습니다.";


            //회원가입이 정상적으로 마치면
            //넘길정보들을 저장하고
        		$_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;

            //난수를 생성해서 메일로 보낸다.
            //받는쪽에서 생성하면 메일이 총 3번 보내지는 문제가 있어 보내는 페이지에서 메일을 보낸다.
            $rand_num = rand(100000,999999);
            $_SESSION['rand_num'] = $rand_num;


            // mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "1");
            mailer("test", "ejxlabvlzhxm@naver.com", $email, "사이트 이메일 인증입니다.", $username."님 인증번호는".$rand_num."입니다.", 1);


        header("Location: welcome.php");
			}
			else
			{
				$errMSG = "사용자 추가 에러";
			}
                     } catch(PDOException $e) {
                        die("Database error: " . $e->getMessage());
                     }



		}

}




//head에서 body로 받아옴.
include('head.php');


//send 버튼 클릭시 메소드 발동

?>






<!--
<script>
//전송버튼 클릭이벤트 메소드
//메일로 난수를 보내고 난수를 저장해서 비교한다.
//1.유저의 메일 저장 2.난수생성 3.난수저장 4.유저메일로 난수 전송
function mailer(){
       var formData = $("#form").serialize();
       console.log($_POST['email']);

       $.ajax({
           cache : false,
           url : "data/test_mail.php", // 요기에
           type : 'POST',
           data : formData,
           success : function(data) {
               var jsonObj = JSON.parse(data);
           }, // success

           error : function(xhr, status) {
               alert(xhr + " : " + status);
           }
       }); // $.ajax */


   }
   </script>


   <script>

   $("#btnSubmit").click(function (event) {

           //preventDefault 는 기본으로 정의된 이벤트를 작동하지 못하게 하는 메서드이다. submit을 막음
           event.preventDefault();

           // Get form
           var form = $('#form')[0];
           console.log(form);
           // Create an FormData object
           var data = new FormData(form);

          // disabled the submit button
           $("#btnSubmit").prop("disabled", true);
           alert("메소드 호출");

           $.ajax({
               type: "POST",
               enctype: 'multipart/form-data',
               url: "data/test_mail.php",
               data: data,
               processData: false,
               contentType: false,
               cache: false,
               timeout: 600000,
               success: function (data) {
                   alert("complete");
                   $("#btnSubmit").prop("disabled", false);
               },
               error: function (e) {
                   console.log("ERROR : ", e);
                   $("#btnSubmit").prop("disabled", false);
                   alert("fail");
               }
           });

       });

   </script>
-->




<div class="container">
	<div>
	<h1 class="h2" align="center">&nbsp; 새로운 사용자 추가</h1><hr>
    </div>
	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>

<!--
보안관련 설정
https://stackanswers.net/questions/how-do-you-disable-browser-autocomplete-on-web-form-field-input-tag


-->
<form id="form" method="post" enctype="multipart/form-data" class="form-horizontal" style="margin: 0 300px 0 300px;border: solid 1px;border-radius:4px">
	<table class="table table-responsive">
    <tr>
        <? $r1 = rmd5(rand().mocrotime(TRUE)); ?>
    	<td><label class="control-label">아이디</label></td>
        <td><input class="form-control" type="text" name="<? echo $r1; ?>" placeholder="아이디를 입력하세요." autocomplete="off" readonly
    onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r1; ?>" value="newusername" />

        </td>
    </tr>
    <tr>
        <? $r2 = rmd5(rand().mocrotime(TRUE)); ?>
    	<td><label class="control-label">패스워드</label></td>
        <td>
            <input class="form-control" type="password" name="<? echo $r2; ?>"  placeholder="패스워드를 입력하세요" autocomplete="off" readonly
                   onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r2; ?>" value="newpassword" />
        </td>
    </tr>
    <tr>
        <? $r3 = rmd5(rand().mocrotime(TRUE)); ?>
    	<td><label class="control-label">패스워드 확인</label></td>
        <td>
            <input class="form-control" type="password" name="<? echo $r3; ?>"  placeholder="패스워드를 다시 한번 입력하세요" autocomplete="off" readonly
                   onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r3; ?>" value="newconfirmpassword" />
        </td>
    </tr>

    <tr>

        <?//이 r4의 값을 어떻게 통제하는 지몰라서 일단 패스
        $r4 = rmd5(rand().mocrotime(TRUE)); ?>
    	<td><label class="control-label">이메일 인증</label></td>
        <td><input class="form-control" type="email"  name="email" placeholder="이메일을 입력하세요" autocomplete="off" readonly
    onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r4; ?>" value="email" />
        </td>
    </tr>



    <tr>
        <td colspan="2" align="center">
         <button type="submit" name="submit"  class="btn btn-primary"> 등록</button>
        </td>
    </tr>
    </table>
</form>
</div>
</body>
</html>
