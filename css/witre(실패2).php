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
      $(document).ready(function() {
          $("#input_imgs").on("change", handleImgFileSelect);
      });

      function fileUploadAction() {
          console.log("fileUploadAction");
          $("#input_imgs").trigger('click');
      }

      function handleImgFileSelect(e) {


          $(".imgs_wrap").empty();
          //선택한 파일들을 저장할 변수를 만든다.
          var files = e.target.files;
          //이 변수를 쪼개는 배열 객체.
          var filesArr = Array.prototype.slice.call(files);

          filesArr.forEach(function(f) {
              if(!f.type.match("image.*")) {
                  alert("확장자는 이미지 확장자만 가능합니다.");
                  return;
              }
              //alert(e.target.result);

              sel_files.push(f);
            });
            //반복문 종료
              //배열에 파일들을 추가



              var index = 0;
              sel_files.forEach(function(){
                alert(sel_files[index].fileToUpload);



                //alert("html 제작 시작");
              //var html = "<img src=\"" + sel_files[index].name "\">";
                  //var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";

                  $(".imgs_wrap").append(html);

              index++;
      });




      }
      //메소드 종료
      function deleteImageAction(index) {
          console.log("index : "+index);
          console.log("sel length : "+sel_files.length);
          sel_files.splice(index, 1);
          var img_id = "#img_id_"+index;
          $(img_id).remove();
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
