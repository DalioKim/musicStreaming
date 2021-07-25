<?php

//디비에 접속한다.
include('data/app_db.php');



//서버에 요청이 있을 시

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ( isset($_POST['request']) ){

//로컬에서 쉐어드에 저장한 아이디정보를 보내서,
//해당 아이디의 회원정보를 요청한다.

 $id=$_POST['request'];
 $sql = mysqli_query($db,"SELECT * from users where userId='".$id."'");


 while($user = $sql->fetch_array()){

   //회원정보가 있으면, 암호화된 비밀번호를 저장하고
   $email = $user["email"];
   //암호화에 사용했던 salt를 들고온다.
   $thumbnail = $user["thumbnail"];

 }


echo json_encode(array("id"=>$id,"email"=>$email,"thumbnail"=>$thumbnail));










  }
}//서버 요청있을 경우 메소드

?>
