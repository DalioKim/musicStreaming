<?php
include 'data/dbcon.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>글쓰기 게시판</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="/css/jumbotron.css" rel="stylesheet">

  </head>

  <style type="text/css">

  input[type=file] {
      display: none;
  }

      .my_button {
          display: inline-block;
          width: 200px;
          text-align: center;
          padding: 10px;
          background-color: #006BCC;
          color: #fff;
          text-decoration: none;
          border-radius: 5px;
          margin-left: 290px;

      }



      .imgs_wrap {

          border: 2px solid #A8A8A8;
          width: 930px;
          background-color: #FFFFFF;
          margin-left: 290px;
          margin-top: 30px;
          margin-bottom: 30px;
          padding-top: 10px;
          padding-bottom: 10px;

      }
      .imgs_wrap img {
        max-width: 150px;
        max-height: 150px;
        margin-left: 10px;
        margin-right: 10px;
      }

  </style>

  <script type="text/javascript" src="./js/jquery-3.1.0.min.js" charset="utf-8"></script>
  <script type="text/javascript">

      // 이미지 정보들을 담을 배열
      var sel_files = [];
      var index = 0;

      //핸들이미지메소드가 호출되면 그 변화를 페이지상에 표시한다.
      $(document).ready(function() {
          $("#input_imgs").on("change", handleImgFileSelect);
      });

      function fileUploadAction() {
          console.log("fileUploadAction");
          $("#input_imgs").trigger('click');
      }


      function handleImgFileSelect(e) {


          // 사진선택 버튼을 클릭할때마다 이미지를 보여주는 태그를 비우는 것을 지움
          //$(".imgs_wrap").empty();
          //선택한 파일들을 저장할 변수를 만든다.
          var files = e.target.files;
          //선택한 각 사진들을 쪼개서 각 요소에 담는 작업
          var filesArr = Array.prototype.slice.call(files);


          //파일을 파라미터로 전달한 후
          //확장자를 체크한다.
          //반복문 시작
          filesArr.forEach(function(f) {
              if(!f.type.match("image.*")) {
                  alert("확장자는 이미지 확장자만 가능합니다.");
                  return;
              }

              //배열에 파일들을 추가(맨뒤에)
//sel_files.push(f);
              //인덱스 번호를 배열의 길이로 이용
              //var index = sel_files.length -1;

              var reader = new FileReader();
              reader.onload = function(e) {

                  //클릭시 삭제가 되게 해주는 부분
                  var html = "<a href=\"javascript:void("+index+");\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
                  //미리보기에 선택한 이미지를 추가해주는 부분
                  $(".imgs_wrap").append(html);
                  //미리보기상에서 사용할 인덱스변수의 값을 증가시켜준다.
                  alert("추가된 이미지 : "+ e.target.result);
                  //alert("배열에 추가된 요소 : "+ sel_files[index]);


              }
              reader.readAsDataURL(f);

          });
          //반복문 종료
          alert("사진배열의 길이: "+sel_files.length);

      }
      //핸들이미지 종료


      function deleteImageAction(index) {
          console.log("index : "+index);
          console.log("sel length : "+sel_files.length);

          //해당인덱스의 요소를 배열로부터  삭제한다.
          //인덱스 번호/
          sel_files.splice(index, 1);


          var img_id = "#img_id_"+index;
          $(img_id).remove();
          //미리보기상에서 사용할 인덱스변수의 값을 감소시킨다.


      }





  </script>

</head>
<body>

  <?php include "navi.php"; /* navi load */
?>


  <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <form class="form-horizontal" method=POST action=write_ok.php enctype="multipart/form-data">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">제목</label>
          <div class="col-sm-10">
            <input type="text" name=title class="form-control" id="inputEmail3">
          </div>
      </div>
    <label for="inputEmail3" class="col-sm-2 control-label">게시글</label>
    <div class="col-sm-offset-2 col-sm-10">
        <textarea name=content class="form-control" rows="10"></textarea>
    </div>
  </div>
  <br/>
  <label for="inputEmail3" class="col-sm-2 control-label" style="margin-left :200px;">이미지 미리보기</label>
  <div class='imgs_wrap' >
      <!-- 미리보기 공간 -->
      <img id="img" />

  </div>
  <a href="javascript:" onclick="fileUploadAction();" class="my_button">사진 선택</a>
  <input type='file' id="input_imgs" name="fileToUpload[]" style="margin-left :250px;" multiple/>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" style="margin-top: 30px;" >작성 완료</button>
        </div>
       </div>
     </form>

  </div>
</div>


</body>

</html>
