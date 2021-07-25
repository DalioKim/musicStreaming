<?php


/**
 * 2020-04-30 김동현
 *페이스북 아이디를 이용한 회원가입
 * 사용자의 페이스북 아이디, 이름, 이메일, 페이스북 링크, 성별정보를 클라이언트로부터 전달받는다.
 * 페이스북 아이디를 통해 회원정보 테이블에 가입여부를 체크한다.


 */

date_default_timezone_set('Asia/Seoul'); //서울 기준으로 시간 셋
$connect = mysqli_connect("localhost","LaV","Teamnova@2","attentiondb");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {



  if ( isset($_POST['facebook_id']) && isset($_POST['member_name']) && isset($_POST['email']) && isset($_POST['facebook_link']) && isset($_POST['gender'])){


    $timestamp = strtotime("Now");
    $now = date("Y-m-d H:i:s", $timestamp); //현재 시간, 상품등록일로 사용
    $facebook_id = $_POST['facebook_id'];
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $facebook_link = $_POST['facebook_link'];
    $gender = $_POST['gender'];

    if($connect){


      # 이전에 회원가입을 했나 체크
      $query_duplicate_check = "SELECT * from member_info where facebook_id = '$facebook_id'";
      $result_duplicate_check = mysqli_query($connect, $query_duplicate_check);
      $duplicate_check = $result_duplicate_check->num_rows;

      if($duplicate_check > 0){ //이미 가입함

        echo json_encode(array("result"=>"arleady"));

      }else{

      $query_join = "INSERT into member_info (facebook_id, member_name, facebook_link, gender, email, user_state, create_date)
          values ('$facebook_id', '$member_name', '$facebook_link', '$gender', '$email', 'normal', '$now')";
      if($connect->query($query_join)){
          $query_select_product_option_id = $connect->insert_id; # 가장 최근에 성공적으로 수행된 INSERT 구문의 첫번째 AUTO_INCREMENT column의 값을 반환
          echo json_encode(array("result"=>"success"));
      }else{
        echo json_encode(array("result"=>"db 저장실패"));
      }

    }

    }else{


      echo json_encode(array("result"=>"db 연결실패"));

    }



  //echo json_encode(array("result"=>"success"));


}else{
echo json_encode(array("result"=>"클라에서 데이터 전달안됨"));
  //echo json_encode(array("result"=>"fail"));

}





}



  ?>
