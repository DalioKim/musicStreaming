<?php
include 'data/dbcon.php';
?>

<!DOCTYPE html>
<html lang ="ko">
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


      .img_file
      {
        width: 200px;
        height: 200px;

      }

      .overlay
      {
      width: 30px;
      height: 30px;
      position: absolute;
      margin-top: 0px;
      margin-right:5px;
      }

  </style>

  <script type="text/javascript" src="./js/jquery-3.1.0.min.js" charset="utf-8"></script>
  <script type="text/javascript">
      // 이미지 정보들을 담을 배열
      var sel_files = [];
      //반복문에 사용할 인덱스 변수들
      var index = 0;
      var idx = 0;
      //불린을 이용해서 삭제메소드가 호출됬음을 저장하고
      //삭제메소드가 호출 된 이후에는 배열의 크기에 맞춰서 추가메소드 내의 인덱스 값이 저장된다.
      var boolean;

       //ajax 중복작동 방지용
       var isRun = false;



      //웹 시작 -> 웹문서 읽기 ->dom객체 생성->ready메소드 실행
      $(document).ready(function() {
        //이벤트 연결
          $("#input_imgs").on("change", handleImgFileSelect);



      });




      function fileUploadAction() {
       console.log("fileUploadAction");
          $("#input_imgs").trigger('click');
   }
      function handleImgFileSelect(e) {
          //배열 선언
          //인덱스 번호
          if(boolean){
          index = sel_files.length;
          console.log("삭제메소드가 사용된 후  인덱스 번호 : "+index)
          }
          console.log("핸들이미지 실행 인덱스 번호: "+index)
          // 이미지 div를 초기화
          //선택한 파일들을 저장할 변수를 만든다.
          var files = e.target.files;
          //이 변수를 쪼개는 배열 객체.
          var filesArr = Array.prototype.slice.call(files);


          //파일을 파라미터로 전달한 후
          //확장자를 체크한다.
          //반복문 시작
          filesArr.forEach(function(f) {
              if(!f.type.match("image.*")) {
                  alert("확장자는 이미지 확장자만 가능합니다.");
                  return;
              }
              //배열에 파일들을 추가
              sel_files.push(f);
              //console.log("객체 키값 확인 : "+ Object.values(sel_files))

              //console.log("배열 길이: "+sel_files.length)

              //path안됨 alert(sel_files[index].path);
              var reader = new FileReader();
              reader.onload = function(e) {
                  //console.log(f.name)
                  //console.log(name)
                  //console.log("타겟 결과 값: " +e.target.result)
                  sel_files[index].url = e.target.result;
                  //console.log("속성추가결과값 : "+ sel_files[index].url)
                  var html = "<a href=\"javascript:void(0);\"  id=\"img_id_"+index+"\"><img src=\"" + e.target.result+ "\" data-file='"+f.name+"'  id=\""+index+"\" class = 'img_file'></a>";

                  //원본 : var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result+ "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";

                  $(function() {
                  var i = index-1;

                  $('#'+i).before('<img src="images/x_button.png" class="overlay" onclick= deleteImageAction('+i+'); title='+i+'>');
                  console.log("추가메소드 내 x버튼 인덱스 번호:"+index)

                  });

                  console.log("html에 저장한 인덱스 번호: " +index)

                  $(".imgs_wrap").append(html);
                  index++;

              }
              reader.readAsDataURL(f);
              console.log("배열길이: "+sel_files.length)

          });
          //반복문 종료
          document.write.array.value=sel_files;
          //document.write.fileToUpload.value=sel_files;


      }
      //메소드 종료
      function deleteImageAction(index) {
          //전달받은 인덱스를 통해, 배열에서 삭제한다.

          console.log("삭제메소드 호출")

          sel_files.splice(index, 1);
          console.log("삭제메소드 호출 후 배열 길이 : "+sel_files.length)

          //요소를 삭제 후, 인덱스를 0으로 정의
          //배열의 길이를 이용한 반복문에서 html객체를 만들때 사용할 인덱스 번호를 리셋
          index =0;
          console.log("요소삭제 후  : "+sel_files.length)

          //이미지 미리보기 태그를 리셋
          //태그의 데이터를 모두 삭제해준 후
          $(".imgs_wrap").empty();

          //다시 배열의 데이터를 html에 넣어 객체를 생성 후, 태그에 추가한다.


          sel_files.forEach(function() {
            console.log("html재배치 메소드 호출")
            console.log("html재배치 메소드 내 인덱스 번호:"+index)

            var html = "<a href=\"javascript:void(0);\"  id=\"img_id_"+index+"\"><img src=\"" + sel_files[index].url+ "\" data-file='"+sel_files[index].name+"' id=\""+index+"\" class = 'img_file'></a>";

            //서버에 접근하는 동안 백그라운드로 빠져서 문제가 발생

          $(".imgs_wrap").append(html);




          index++;

          });
          //var img_id = "#img_id_"+index;
          //$(img_id).remove();
          //const idx = sel_files.findIndex(function(item) {return sel_files.name == name})

          //if (idx > -1) sel_files.splice(idx, 1)
          //console.log("sel length : "+sel_files.length);
         //index = sel_files.legnth;
        // console.log("삭제 후 배열길이: "+sel_files.length)
        var i =0;
        sel_files.forEach(function() {

        $('#'+i).before('<img src="images/x_button.png" class="overlay" onclick= deleteImageAction('+i+'); title='+i+'>');
        console.log("삭제메소드 내 x버튼 인덱스 번호:"+index)
        i++
                  });

        boolean =true;


      }


      //글쓰기 입력버튼을 누르면
      //
      function submitAction() {

          console.log("업로드 파일 갯수 : "+sel_files.length);
          //글의 제목,내용,이미지를 담을 Form데이터를 선언
          var data = new FormData();
          //파일객체의 name key에 imgae+인덱스번호의 값을 저장
          for(var i=0, len=sel_files.length; i<len; i++) {
              var name = "image_"+i;
              data.append(name, sel_files[i]);
          }
          //총 파일의 숫자를 formData에 저장
          data.append("image_count", sel_files.length);
          //console.log("데이터에 담긴 이미지 숫 : "+data.content);
          if(sel_files.length < 1) {
              alert("한개이상의 파일을 선택해주세요.");
              return;
          }

          //글의 제목과 내용을 저장
          var content = $("#content").val();
          console.log("content에 담긴 내용데이터 : "+content);
          data.append("content", content);
          //console.log("데이터에 담긴 내용데이터 : "+data.content);


          var title = $("#inputEmail3").val();
          //console.log("title에 담긴 내용데이터 : "+title);
          data.append("title", title);
          //console.log("데이터에 담긴 제목데이터 : "+data.title);


       console.log("데이터배열의 키값 : "+Object.keys(data));
       console.log("데이터배열의 밸류 : "+Object.values(data));

        //ajax 중복작동 방지
        if(isRun == true) {
          return;
        }
        isRun = true;



          //ajax로 파일을 업로드하고 글에 관한 데이터를 저장하는 php로 데이터를 보낸후에
          $.ajax({
            dataType: 'json',
              data : data,
              type: 'post',
              url: 'write_ok.php',
              processData: false,
              contentType: false,
              complete : function() {
                 isRun  = false;
               location.href = "free_board.php";
     }




            });
            //다시 게시판으로 이동한다.


      }










  </script>

</head>
<body>

  <?php include "navi.php"; /* navi load */
?>


  <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <form class="form-horizontal">
      <input type="hidden" name="array" value="">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">제목</label>
          <div class="col-sm-10">
            <input type="text" name=title class="form-control" id="inputEmail3">
          </div>
      </div>
    <label for="inputEmail3" class="col-sm-2 control-label">게시글</label>
    <div class="col-sm-offset-2 col-sm-10">
        <textarea name=content class="form-control" id ="content" rows="10"></textarea>
    </div>
  </div>
  <br/>
  <label for="inputEmail3" class="col-sm-2 control-label" style="margin-left :200px;">이미지 미리보기</label>
  <div class='imgs_wrap' >
      <!-- 미리보기 공간 -->
      <img id="img" />

  </div>
  <a href="javascript:" onclick="fileUploadAction();" class="my_button">사진 선택</a>
  <input type='file' id="input_imgs" name="fileToUpload"  style="margin-left :250px;" />

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <!--input type='button' onclick="submitAction();" value="작성완"-->
      <button type="button" class="btn btn-default" onclick="submitAction();" style="margin-top: 30px;" >작성 완료</button>
      <!--button type="submit" class="btn btn-default" onclick="submitAction();" style="margin-top: 30px;" >작성 완료</button-->

        </div>
       </div>
     </form>

  </div>
</div>


</body>

</html>
