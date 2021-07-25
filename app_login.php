<?php

//디비에 접속한다.
include('data/app_db.php');


//서버에 요청이 있을 시

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ( isset($_POST['id']) && isset($_POST['pwd']) ){

    //안드로이드(클라)에서 전송한 아이디와 비밀번호를 저장
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];








    //디비에 접근해서 일치하는 아이디의 회원정보가 있는지 체크한다.
    $sql = mysqli_query($db,"SELECT * from member where userId='".$id."'");
    $row_num = mysqli_num_rows($sql);



    if($row_num == 1){

      while($user = $sql->fetch_array()){

        //회원정보가 있으면, 암호화된 비밀번호를 저장하고
        $encrypted = $user["pwd"];
        //암호화에 사용했던 salt를 들고온다.
        $salt = $user["salt"];

        $dbpwd = $user["pwd"];

      }



        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
        chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        //암호화된 비밀번호를 복호화
        $decrypted = openssl_decrypt(base64_decode($encrypted), 'aes-256-cbc', $salt, OPENSSL_RAW_DATA, $iv);

        //코드오류로 인해 비밀번호 임시처리


        if($pwd == $dbpwd){
          //비밀번호가 일치하면 로그인 성공
          //세션에 아이디 저장

          echo json_encode(array("response"=>"ok"));

        }else{
          //비밀번호가 일치하지 않으면 패스워드 문제있다고 클라에 알려줌
          echo json_encode(array("response"=>"pwd"));

        }

    }else if($row_num == 0){
      //아이디가 존재하지않으면 아이디가 없다고 알려줌
    echo json_encode(array("response"=>"id"));

    }





  }//데이터 받았을떄
}//서버 요청있을 경우 메소드
