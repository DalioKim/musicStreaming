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

    	$image_id = "image_".$i;
    	$image_file = time().$i.".jpg";
      //echo "이미지파일 : ".$image_file;

      $files[$i] = $image_file;
      echo $i."번 인덱스 값: ".$image_file;


    	if(isset($_FILES[$image_id]) && !$_FILES[$image_id]['error']) {
    		if(in_array($_FILES[$image_id]['type'], $imageKind)) {
    			if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.$image_file)) {
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
$id = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");

echo "타이틀 : ".$title;



//자동증가컬럼은 데이터를 db에 넣어줄 필요가 없다.
$stmt = mysqli_query($db, "INSERT into free_board (title, id, content, filename, hit, recommend, create_date) values ('$title','$id','$content','$file', '0', '0', '$date')");





    ?>
