<?php
include "data/db.php"; /* db load */
//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo $user_id;
$index = 1;
//인피니티 스크롤과  좋아요 메소드에 사용하려다가 실패해서 안쓰는 변수 $count = 0;

?>





<!doctype html>
<html lang ="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
<title>#music_title</title>

  <meta charset="UTF-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>



<style>
    body {
        margin: 0;
        padding: 0;

    }

    .headC {
        position: relative;
        height: 100px;
        width: 100%;
        top: 0;
        left: 0
    }

    #headI {
        position: fixed;
        background-color: white;
        border-bottom: gray 1px solid;
        z-index: 100;
    }

    .space {
        width: 100%;
        height: 10%
    }

    #headI #audio audio {
        width: 100%;
        height: 100%;
    }

    #musictitle {
        cursor: pointer;
        height: 30%;
        width: 100%;
        text-align: center;
        white-space: nowrap;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        overflow: hidden;
        -moz-binding: url('ellipsis.xml#ellipsis');
    }

    audio {
        width: 80%;
    }

    .tailC {
        position: relative;
        height: 50px;
        width: 100%;
        bottom: 0;
        left: 0
    }

    #tailI {
        position: fixed;
        background-color: white;
        text-align: center;
        z-index: 100;
    }

    #tailI input {
        width: 15%;
        height: 100%;
        font-size: 20pt;
        -webkit-appearance: button;
        -webkit-border-radius: 0;
    }

    #dirlist {
        padding-top: 20px;
    }

    #dirlist .listentity:last-child {
        border-bottom: 0
    }

    #playlist {
        padding-bottom: 20px;
    }

    .listentity {
        -webkit-margin-before: 0;
        -webkit-margin-after: 0;
        -webkit-padding-start: 10px;
        -webkit-padding-end: 10px;
        width: calc(100% - 20px);
        height: 30px;
        margin: 0 auto;
        border-top: 1px gray dashed;
        position: relative;
        clear: left;
        list-style: none;
        cursor: pointer
    }

    .listentity:hover {
        background-color: #CCCCCC
    }

    .listentity:last-child {
        border-bottom: 1px gray dashed;
    }

    .listentity li {
        line-height: 30px;
        vertical-align: middle;
        font-size: 10pt;
        float: left
    }

    .mtitle {
        width: 77%;
        white-space: nowrap;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        overflow: hidden;
        -moz-binding: url('ellipsis.xml#ellipsis');
    }

    .mtitle2 {
        width: 100%;
        white-space: nowrap;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        overflow: hidden;
        -moz-binding: url('ellipsis.xml#ellipsis');
    }

    .mcurrent {
        width: 5%;
        color: transparent
    }

    .msize {
        text-align: right;
        width: 8%;
        padding-left: 5%;
    }

    .active {
        font-weight: bold;
    }

    .active .mcurrent {
        color: black
    }

    a, a:hover, a:link, a:visited, a:active {
        color: gray;
        text-decoration: none;
    }

    .jumbotron {
      background-image: url("images/lsdgroup.jpg");
      background-size: cover;
      text-shadow: black 0.2em 0.2em 0.2em;
      color: white;
      height: 400px;
    }


    .btn-img{
      width: 30px;
      height: 30px;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>





<body>
<?php include "navi.php"; /* navi load */
?>


         <!-- jumbotron -->
         <div class="container">
           <div class="jumbotron mt-3">
              <h1 class="text-center">Music to GoodTrip</h1>
               <p class="text-center">MtG와 떠나는 일렉여행</p>
             </div>
           </div>



<!-- 음악테이블-->
  <div class="jumb" style="height:100% !important">

    <!--검색창-->
    <div style="height:80px;">
    <form class="navbar-form navbar-left" role="search" style="margin-left :500px;">
    <div class="form-group">
    <select name="catgo">
    <option  value="title">곡명</option>
    <option  value="artist">아티스트</option>
    </select>
    <input type="text" class="form-control" placeholder="Search" name="Search">
    </div>
    <button type="button" class="btn btn-default" onclick="search();">확인</button>
    </form>
    </div>

      <div class="container">
          <table class="table table-striped" >
              <thead>
              <tr>
                  <th width="50">번호</th>
                  <th width="300">곡명</th>
                  <th width="120">아티스트</th>
                  <th width="100">장르</th>
                  <th width="150">좋아요</th>
                  <th width="50">듣기</th>
                  <th width="50">담기</th>
              </tr>
              </thead>
              <tbody class="tbody" id="origin">




  <?php

// 장르별 데이터의 총 갯수를 세주는 부분

  $sql = mysqli_query($db, "SELECT * FROM music where genre='electronic' ");

  $row_num = mysqli_num_rows($sql); //장르별 총 저장된 음악 수

//변수는 다른 폴더에서 받아와서 사용해라



$mql = mysqli_query($db, "SELECT * FROM music where genre='electronic' order by recommend desc, title asc limit 0, 5");


//1.로그인한 유저가 마이뮤직리스트에 저장한 음악 데이터를 가져온다.
$mysql = mysqli_query($db, "SELECT * FROM my_music where id = '" . $user_id . "' ");

//사용자의 마이페이지에 저장되어있는 곡명을 자바로 옮길 수 있도록 구분자를 넣어
//배열에 옮긴다.
while($trans =  $mysql->fetch_array()){

		$mylist[] = $trans['title'];

	}


/*실패
$diff = 0;
$AreaName = "";

while($mylist = mysql_fetch_array($mysql)) {
if ($diff++ != 0) {
$AreaName .= ",";
}
$AreaName .= "'".$mylist[title]."'";
}
*/



//로그인한 아이디와 일치하는 데이터만 좋아요 테이블로부터 가져온다
$lql = mysqli_query($db, "SELECT * FROM music_like where user_id = '" . $user_id . "' ");

//좋아요에 저장된
while($row =  $lql->fetch_array()){

		$data[] = $row['title'];

	}

  //
    while($music = $mql->fetch_array()){

      //$filename = $music['filename'];
  ?>
  <!--tr class="tr" onclick='javascript:trClick(this);'-->
  <tr class="tr" onclick='javascript:trClick(this);'>

    <td width="50"><?php echo $index?></td>
    <td width="50"><?php echo $music['title']?></td>
    <!--전송할 데이터들을 hidden 타입으로 놔둔다.-->
    <input type="hidden" name="title" value="<?php echo $music['title']; ?>" />
      <input type="hidden" name="filename" value="<?php echo $music['filename']; ?>" />
      <input type="hidden" name="genre" value="<?php echo $music['genre']; ?>" />
      <td width="120"><?php echo $music['artist']?></td>
      <td width="100"><?php echo $music['genre']?></td>
    <td width="50"><button  type="button" onclick="like(this);" style="width:20%;float:left"><img class="btn-img" src="<?php if(in_array($music['title'], $data)){echo "images/like.png";
  }else{echo "images/unlike.png";}?>"></button><h4 style="float:left; height:auto;">&nbsp; &nbsp;<?php echo $music['recommend']?></h4></td>
  <td width="50"> <input type="button" value="재생" onclick="play(this);"></td>
  <td width="50"> <input type="button" value="담기" onclick="save(this);"></td>

  </tr>


  <?php $index++;} ?>
</tbody>
<tbody class="tbody" id="search">
</tbody>

</table>





    <div id="tailI" class="tailC">


    <audio id="audio" autoplay controls src =""></audio>

    </div>
    <div id="faketail" class="tailC"></div>

  </body>







    <script language="javascript" type="text/javascript">

    //2.스크립트에서 회원이 추가한 음악정보의 php배열값받아오기
    var mylist = <?php echo json_encode($mylist)?>;


          //음악재생 메소드
          function play(tr){

            var index =tr.parentNode.parentNode.rowIndex-1; // 2
            //alert(index);

            var filename = document.getElementsByName('filename')[index].value;
            document.getElementById("audio").src = 'music/'+ filename;
            //alert(filename);
            var audiocontrol = document.getElementById("audio");
            //오디오 on/off 여부에 따라 시작 정지 결정
            if(audiocontrol.paused)audiocontrol.play();
            else audiocontrol.pause();
          }//음악재생메소드 종료



    //인피니티 스크롤 메소드

    $(document).ready(function() {

      var count = 0;

      var data = <?php echo $row_num; ?>;
        var win = $(window);
        // Each time the user scrollss

        win.scroll(function() {
          //이곳에서 카운트하면 스크롤 움직일때마다 카운트 됨

            // End of the document reached?
            if ($(document).height() - win.height() == win.scrollTop()) {

              //count +=5;
              //alert(count);

              count +=5;


                $('.table table-striped').show();

                if(count<data){
                $.ajax({
                    data : {param : count},
                    type: 'post',
                    url: 'elec_infiniti.php',
                    dataType: 'html',
                    success: function(html) {
                        $('#origin').append(html);
                        //$('.tr').hide();
                    }
                });
              }//카운트 조건
            }
        });

    });


    //담기버튼

    function save(tr){

        //인덱스번호를얻어
        //클릭한 행에 저장된 음악명을 받아와 변수에 저장후
        //ajax로 db작업을 하는 php 파일로 보낸다.

          var index =tr.parentNode.parentNode.rowIndex-1; // 2
          //alert(index);
            var title = document.getElementsByName('title')[index].value;
            //php변수에 곡명 저장하기
            <?php //$title = '<script> document.write(title);</script>';

          //alert(title);
          //<?php $title ?>
          //사용자가 마이리스트에 추가한 정보가 담긴 php배열을
          //js로 옮긴다
          //var array = new Array(<?=$AreaName?>);


          //3.배열로 검사하기
          //배열로 값이 있는지 없는지 확인한다
          if (mylist.indexOf(title) != -1) {
            alert("이미 추가된 곡입니다.");
          }else{
            alert( title+"곡이 추가됩니다.");
            //4.중복추가를 막기위해 현재 배열에 타이틀을 추가한다.
            //js 배열이 php에 의해 초기화되기떄문에 무의미
            mylist.push(title);
            //for(var i=0;i<mylist.length;i++){ //배열 출력
              //  alert(mylist[i]);
            //}
            <?php //array_push($mylist, $title));?>



            $.ajax({
                data : {data : title},
                type: 'post',
                url: 'save_my_music.php',
                dataType: 'json',
                        });
          }

    }







  //좋아요 버튼 클릭이벤트




        function like(tr){

          //인덱스를 이용하여 행의 번호를 갖고오고
          //행의 번호를 이용해서 행에 값들을 가져온다.
          var rowCount = $('#origin tr').length;
          var index =tr.parentNode.parentNode.rowIndex-1; // 2

          var title = document.getElementsByName('title')[index].value;
          //document메소드를 2개가 있으면 버튼이 한번 클릭후 실행되지 않음.
          //var genre = document.getElementsByName('genre')[index].value;

          //alert("길이"+length);
          //alert(title);


          $.ajax({

              type: 'post', //post로
              url: 'elec_like_ok.php',
              data : {title : title, count : rowCount},
              dataType : 'html',
            success: function(data){

              //변경된 데이터를 태그상에 반영한다.
                //$("#origin").html(data).setAttribute("tbody", "tbody");

              //$("#mainMenu").append("<li>c</li>").setAttribute("class", "tbody");
              //$('.tr').hide();
              $('#origin').html(data);

              }
              //이 부분에 넣어주면 데이터 자체가 리셋되어 전송이 안됨

            });

      }



//검색기능

      function search(){

      //검색버튼이 눌러지면
      //인피니티 스크롤을 정지하기 위해 인피니티 스크롤 발동조건의 조건변수를 조정한다.
      //필요 없음count = 100;

      //카테고리에 담긴 옵션 값과
      //검색창에 입력된 값을 가져온다.
      var category =  $("select[name=catgo]").val();
      var search =  $("input[name=Search]").val();

        //실패 한 방법 var category = document.getElementById('category').value;
        //var search = document.getElementById( 'abc' ).getAttribute( 'href' );
        //alert(search);
      //데이터들을 php파일로 보낸다.


        $.ajax({

            type: 'post', //post로
            url: 'search_ok.php',
            data : {category : category, search : search},
            dataType : 'html',
          success: function(data){


            $('#search').html(data);
            $('#origin').hide();

            }

          });

    }






//오디오객체관련 메소드 및 변수
//아직 공부안해서 뭔지 잘모르겠음
    var audio;
    var playlist;
    var tracks;
    var current;
    var loop = false;

    init();

    function init() {
        current = 0;
        audio = $('#audio');
        playlist = $('#playlist');
        tracks = playlist.find('ul');
        len = tracks.length - 1;
        audio[0].play();
        playlist.find('ul').click(function(e) {
            link = $(this);
            current = link.index();
            run(link, audio[0]);
        });
        audio[0].addEventListener('ended', function(e) {
            if(!loop){
                current++;
                if (current == len + 1) {
                    current = 0;
                    link = playlist.find('ul')[0];
                } else {
                    link = playlist.find('ul')[current];
                }
            }
            run($(link), audio[0]);
        });
        audio[0].addEventListener("pause", function() {
            $('#play').attr("value", ">");
        });
        audio[0].addEventListener("play", function() {
            $('#play').attr("value", "||");
        });
    }

    function run(link, player) {
        player.src = link.attr('data');
        par = link;
        $('#musictitle').html(link.attr('data'));
        document.title = link.attr('data');
        par.addClass('active').siblings().removeClass('active');
        audio[0].load();
        audio[0].play();
        $('#play').attr("value", ">");
    }
    $('#prev').click(function() {
        current--;
        if (current == -1) {
            current = len;
        }
        link = playlist.find('ul')[current];
        run($(link), audio[0]);
    });
    $('#play').click(function() {
        if (audio[0].paused == false) {
            audio[0].pause();
            $('#play').attr("value", ">");
        } else {
            audio[0].play();
            $('#play').attr("value", "||");
        }
    });
    $('#next').click(function() {
        current++;
        if (current == len + 1) {
            current = 0;
            link = playlist.find('ul')[0];
        } else {
            link = playlist.find('ul')[current];
        }
        run($(link), audio[0]);
    });
    $('#loop').click(function() {
        if(!loop){
            loop = true;
            $('#loop').attr("value", "!@");
        }else{
            loop = false;
            $('#loop').attr("value", "@");
        }
    });

    $('#dirlist').find('ul').click(function(e) {
        location.href = $(this).attr("data");
    });

    $('#musictitle').click(function() {
        alert($('#musictitle').html());
    });

    $(document).ready(function() {
        var event = document.createEvent("HTMLEvents");
        event.initEvent("click", true, false);
        playlist.find('ul')[0].dispatchEvent(event);
        var browserCheckText = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Symbian', 'Windows Phone', 'webOS', 'Opera Mini', 'Opera Mobi', 'POLARIS', 'IEMobile', 'nokia');
        for (var word in browserCheckText) {
            if (navigator.userAgent.toUpperCase().match(browserCheckText[word].toUpperCase()) != null) {
                $('#play').attr("value", ">");
                audio[0].pause();
                break;
            }else{
                $('#play').attr("value", "||");
            }
        }
    });

    <!-- Matomo -->

    var _paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u="//sadangro.shop/matomo/";
      _paq.push(['setTrackerUrl', u+'matomo.php']);
      _paq.push(['setSiteId', '1']);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();

    <!-- End Matomo Code -->




</script>



</html>
