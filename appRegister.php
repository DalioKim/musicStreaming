<?php

//디비에 접속한다.
include('data/app_db.php');
//smtp 인클루드
include_once('data/mailer.lib.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  echo "start";
  console.log("start");

  if (isset($_POST['email'])){
    echo "조건문";

    $email = $_POST['email'];
    echo "이메일".$email;

    $sql = mysqli_query($db,"SELECT * from users where email='".$email."'");
    $row_num = mysqli_num_rows($sql);

//이메일 중복검사




if($row_num == 0){



    //난수를 생성해서 메일로 보낸다.
    //받는쪽에서 생성하면 메일이 총 3번 보내지는 문제가 있어 보내는 페이지에서 메일을 보낸다.
    $rand_num = rand(100000,999999);
    mailer("앱 관리", "", $email, "사이트 이메일 인증입니다.", " 인증번호는".$rand_num."입니다.", 1);
    //인증번호를 안드로이드로 전송해준다.

    $error="ok";

echo json_encode(array("response"=>$error, 'ran_num' => $rand_num));

}else if($row_num > 0){
  $error="fail";
echo json_encode(array("response"=>$error));
  }
  //echo json_encode(array("response"=>$error, 'ran_num' => $rand_num));

  }


  if (isset($_POST['id'])){

    //echo "조건문 통과";

    $id = $_POST['id'];
    //echo $id;
    //$id = "user";

    //$sql = mysqli_query($db,"SELECT * from users where userId ='".$id."'");
    //$row_num = mysqli_num_rows($sql);

    //echo $row_num;
  //  if($row_num == 0){
      $error="ok";



  //  }else if($row_num > 0){
    //  $error="fail";

    //  }
    //echo "json:".json_encode(array("response"=>$error));

    echo json_encode(array("response"=>$error));



    }





}

?>
