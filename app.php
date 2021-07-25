<?php

//디비에 접속한다.
include('data/app_db.php');



//서버에 요청이 있을 시

if ($_SERVER['REQUEST_METHOD'] == 'POST') {






  if (isset($_POST['id'])){

    $id = $_POST['id'];
    //$id = "user";
    $stmt = mysqli_query($db, "INSERT into test (id) values ('$id')");

    //$sql = mysqli_query($db,"SELECT * from users where userId ='".$id."'");
    //$row_num = mysqli_num_rows($sql);

    //echo $row_num;
  //  if($row_num == 0){
      $error="ok";



  //  }else if($row_num > 0){
    //  $error="fail";

    //  }

    echo json_encode(array("response"=>$error));

    }















}//서버 요청있을 경우 메소드








//include(“../connect/init.php”);
/*
if (isset($_POST['email'])){
// username and password sent from link
$id = $_POST['id'];
$stmt = mysqli_query($db, "INSERT into test (id) values ('$id')");

echo $id;
}
*/










?>
