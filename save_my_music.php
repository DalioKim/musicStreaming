<?php

//사용자가 저장하고자 할 음악을 담았을떄
//ajax를 통해 실시간으로 저장이 된다.
//디비에 사용자의 아이디로 저장된 같은 음악이 없는지 체크하고
//저장한다.
include "data/db.php"; /* db load */

error_reporting(E_ALL);
//ini_set('display_errors', 1);

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
//ajax로 전달한 노래제목을 post로 받아, 변수에 저장한다.
$title = $_POST[data];
//현재 날짜를 저장한다.
$date = date("Y-m-d H:i:s");




//디비에 접근해서 해당 id로 저장한 음악 중 동일 한 아이디가 있는지 중복검사를 한후
$check = mysqli_query($db,"select * from my_music where id = '" . $user_id . "' and  title = '" . $title . "' ");
$row_num = mysqli_num_rows($check); //중복수 체크

if ($row_num > 0){
   $errMSG = "이미 존재하는 노래입니다.";

     //없으면 저장을 한다.
}else{
  $sql = mysqli_query($db,"insert into my_music(id,title,create_date,favorite) values('".$user_id."','".$title."','".$date."', '0')");

}



?>
