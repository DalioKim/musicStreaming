<?php
//db를 연결한다.
include('data/dbcon.php');
include('data/db.php');
    //에러 체크
error_reporting(E_ALL);
ini_set("display_errors", 1);


    //확장자를 구분하고
    $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
    //이미지를 올릴 서버경로를 변수에 저장하고
    $dir = "upload/images/";
    $files =  array();







    for($i=0; $i<$_POST['image_count']; $i++) {

      $key = "key_".$i;
      $image_id = "image_".$i;
    	$image_file = time().$i.".jpg";
      //echo "이미지파일 : ".$image_file;

      echo "키 값".$key;

      echo $_POST[$key];

      //이미 업로드된 파일과 그렇지 않은 파일을 php배열에 분류해서 저장한다.
      if((isset($_POST[$key]))){
        $files[$i] = $_POST[$key];
        echo $i."번 인덱스 값: ".$files[$i];
      }else{
      $files[$i] = $image_file;
      echo $i."번 인덱스 값: ".$image_file;
    }

    	if(isset($_FILES[$image_id]) && !$_FILES[$image_id]['error']) {
    		if(in_array($_FILES[$image_id]['type'], $imageKind)) {
    			if(move_uploaded_file($_FILES[$image_id]['tmp_name'], $dir.$image_file)) {
    				echo "Success Upload Image <br/>";
    			} else {
    				echo "Error Upload Image <br/>";
    			}
    		} else {
    			echo "Not Image Type <br/>";
    		}
    	} else {
    		echo "Image Upload Fail <br/>";
    	}

    }


//파일명을 저장하는 배열에 값이 다 저장되면
//배열을 다시 imploed 해준다.
$file =  implode( '/',$files);
echo "파일합친 값: ".$file;


//이미지 처리 작업이 종료가 되면
//세션으로 받아온 아이디,
//post로 받아온 제목과 텍스트 내용
//시간함수를 통해 저장한 시간변수
//이미지변수를 db에 저장한다.

$title = $_POST['title'];
$content = $_POST['content'];
$idx = $_POST['idx'];
$id = $_SESSION['user_id'];
$up_date = date("Y-m-d H:i:s");

echo "타이틀 : ".$title;
echo "idx : ".$idx;
echo "파일명 : ".$file;




//제목 내용 파일명 업데이트 날짜를 셋해준다.
$fet = mysqli_query($db, "UPDATE free_board set title = '" . $title . "', content = '" . $content . "',
filename = '" . $file . "',  update_date = '" . $up_date . "'   where idx = '" . $idx . "'");



    ?>
