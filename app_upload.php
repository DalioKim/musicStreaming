<?php


include('data/app_db.php');





//$response = array();

// Check if image file is an actual image or fake image


  if (isset($_FILES["file"]) && isset($_POST['email']) && isset($_POST['id']) && isset($_POST['pwd']) )
  {


    $file_name = time().".jpg";
    //안드(클라)로부터 온 데이터를 각 변수에 저장
    $email = $_POST['email'];
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $date = date("Y-m-d H:i:s");
    //part로 보낼시 따음표가 붙어짐 따옴표 제거


    $email = str_replace( "\"","", $email ); // 쌍따옴표 제거
    $id = str_replace( "\"","", $id ); // 쌍따옴표 제거
    $pwd = str_replace( "\"","", $pwd ); // 쌍따옴표 제거


    //파일경로 지정
     $file_path = "app_upload/images/";
   //업로드에 성공했을시
    if(move_uploaded_file($_FILES['file']['tmp_name'], $file_path.$file_name)) {


      //pwd를 암호화 처리해준다.

      $salt = bin2hex(openssl_random_pseudo_bytes(32));

      $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
      chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);


      //암호화
      $encrypted = base64_encode(openssl_encrypt($pwd, 'aes-256-cbc', $salt, OPENSSL_RAW_DATA, $iv));
      //복호화
      //$decrypted = openssl_decrypt(base64_decode($encrypted), 'aes-256-cbc', $salt, OPENSSL_RAW_DATA, $iv);


      //사진 있는 경우와 없는 경우를 구분

      //사진이 있을떄

      //$update_sql = mysqli_query($db, "UPDATE users set thumbnail = '" . $file_name . "' where email ='" . $email . "'");

      $stmt = mysqli_query($db, "INSERT into member (userId, pwd, email, salt, cDate, thumbnail) values ('$id','$encrypted','$email','$salt','$date','$file_name')");

      //echo json_encode(array("response"=>"조건문 안"));


      if($stmt){
      echo json_encode(array("response"=>"ok"));
      }


    }else{
      echo json_encode(array("response"=>"fail"));

      //echo json_encode(array("response"=>"fail"));
    }

/*
    if(move_uploaded_file($_FILES["file"]['tmp_name'],"app_upload/images/1.jpg")) {
      echo json_encode(array("response"=>"ok"));
    } else {
      echo json_encode(array("response"=>"fail"));
    }
*/




  }








?>
