<?php

//디비에 접속한다.
include('data/app_db.php');
//smtp 인클루드
include_once('data/mailer.lib.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['email'])){

    $email = $_POST['email'];

    $sql = mysqli_query($db,"SELECT * from users where email='".$email."'");
    $row_num = mysqli_num_rows($sql);

//이메일 중복검사


if($row_num == 0){

    //난수를 생성해서 메일로 보낸다.
    //받는쪽에서 생성하면 메일이 총 3번 보내지는 문제가 있어 보내는 페이지에서 메일을 보낸다.
    $rand_num = rand(100000,999999);
    mailer("앱 관리", "", $email, "사이트 이메일 인증입니다.", " 인증번호는".$rand_num."입니다.", 1);
    //인증번호를 안드로이드로 전송해준다.

   $result = "ok";
    echo json_encode(array("response"=>$result, 'ran_num' => $rand_num));


}else if($row_num > 0){

echo json_encode(array("response"=>"fail", 'ran_num' => $rand_num));

  }

}//email값 받아왔을떄 실행되는 조건문

if (isset($_POST['id'])){



  $id = $_POST['id'];


  $sql = mysqli_query($db,"SELECT * from users where userId ='" . $id . "' ");
  $row_num = mysqli_num_rows($sql);

 if($row_num == 0){
   echo json_encode(array("response"=>$id));


  }else if($row_num > 0){
  echo json_encode(array("response"=>"fail"));

    }




}//아이디 체크 조건문





}

?>
