<?php

//디비에 접속한다.
include('data/app_db.php');
echo "page load";


//서버에 요청이 있을 시

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 echo "start";

//중복체크를 위해서 안드(클라)에서 아이디 데이터를 전송했을떄
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
