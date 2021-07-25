<?php
include "data/db.php"; /* db load */

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo $user_id;
$index = 1;

//테이블 데이터 복사를 하기 위해 시도했지만 실패한 쿼리문
//$sql = mysqli_query($db, "INSERT INTO elec_music SELECT * FROM reggae_music");
//$sql2 = mysqli_query($db, "INSERT INTO elec_music SELECT * FROM funky_music");



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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>



<style>
    body {
        margin: 0;
        padding: 0;

    }


    .jumbotron {
      background-image: url("images/jack_u2.jpg");
      background-size: cover;
      text-shadow: black 0.2em 0.2em 0.2em;
      color: white;
      height: 600px;
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

</style>

</head>





<body>


  <?php include "navi.php"; /* navi load */
  ?>
         <!-- jumbotron -->
         <div class="container">
           <div class="jumbotron mt-3">
              <h1 class="text-center">Music to GoodTrip</h1>
               <p class="text-center">자신만의 플레이 리스트를 만들어보세요</p>
             </div>
           </div>

  <div class="jumb" style="height:100% !important">
      <div class="container">
          <table class="table table-striped" >
              <thead>
              <tr>
                  <th width="50">번호</th>
                  <th width="400">곡명</th>
                  <th width="120">아티스트</th>
                  <th width="100">장르</th>
                  <th width="75">재생 버튼</th>
                  <th width="75">재생 횟수</th>
              </tr>
              </thead>
              <tbody class="tbody">




  <?php


//변수는 다른 폴더에서 받아와서 사용해라

  //$row_num = mysqli_num_rows($sql); //게시판 총 레코드 수



//많이 들은 횟수를 기준으로 정렬
//order by favorite asc limit 0, 4
    //$sql2 = mysqli_query($db,"select my_music.*, music.filename, music.artist, music.genre from my_music inner join music on my_music.title = music.title ");

    //echo $data[];
    //$sql2 = mysqli_query($db,"SELECT music.title, music.filename, music.artist, music.genre FROM my_music INNER JOIN music ON my_music.title=music.title");

    //$sql2 = mysqli_query($db,"select * from music where title = '" . $title . "' ");


    //사용자가 저장한 총 음악의 숫자를 세는 작업
    //join문으로 데이터를 불러온 후

/*
    $sql = mysqli_query($db, "SELECT my_music.*, elec_music.filename, elec_music.genre, elec_music.artist, my_music.favorite,
      reggae_music.filename, reggae_music.genre, reggae_music.artist,
      funky_music.filename, funky_music.genre, funky_music.artist

    FROM my_music INNER JOIN elec_music
    ON  my_music.title = elec_music.title,

    INNER JOIN reggae_music
    ON  my_music.title = reggae_music.title,

    INNER JOIN funky_music
    ON  my_music.title = funky_music.title

    where my_music.id = '" . $user_id . "' order by favorite asc ;");

    //데이터의 총 행의 숫자를 세어
    //인피니티 스크롤에 이용한다.
    $row_num = mysqli_num_rows($sql);
    //echo $row_num;

    //모든 데이터 중에서 일부만 보여주기 위해서
    //리미트를 이용하여 db로부터 제한된 데이터만 가지고 온다.

    $sql2 = mysqli_query($db, "SELECT my_music.*, elec_music.filename, elec_music.genre, elec_music.artist, my_music.favorite
    FROM my_musicb INNER JOIN elec_music
    ON  my_music.title = elec_music.title where my_music.id = '" . $user_id . "' order by favorite desc limit 0, 5;");


    //$sql2 = mysqli_query($db, "SELECT * FROM my_music INNER JOIN elec_music ON my_music.title = elec_music.title INNER JOIN reggae_music ON my_music.title = reggae_music.title where my_music.id = '" . $user_id . "' order by favorite desc limit 0, 5;");
*/

  //전체 데이터 숫자를  카운팅하기 위해 db접속
  $sql = mysqli_query($db, "SELECT *
    FROM my_music
       inner JOIN music ON my_music.title = music.title where my_music.id = '" . $user_id . "' ;");

       $row_num = mysqli_num_rows($sql);


    $sql2 = mysqli_query($db, "SELECT *
        FROM my_music
           inner JOIN music ON my_music.title = music.title where my_music.id = '" . $user_id . "'
           order by favorite desc, music.title asc limit 0, 5;");


    //댓글db에 있는 데이터들을 가져와 행별로 출력한다.
    //while($reply = $sql3->fetch_array()){
    while($music = $sql2->fetch_array()){

      //$filename = $music['filename'];
  ?>
  <!--tr class="tr" onclick='javascript:trClick(this);'-->
  <tr class="tr" onclick='javascript:trClick(this);'>
    <td width="50"><?php echo $index?></td>
    <td width="400"><?php echo $music['title']?></td>
    <input type="hidden" name="title" value="<?php echo $music['title']; ?>" />
      <input type="hidden" name="filename" value="<?php echo $music['filename']; ?>" />
      <td width="120"><?php echo $music['artist']?></td>
      <td width="100"><?php echo $music['genre']?></td>
      <td width="75"> <input type="button" value="재생" onclick="play(this);"></td>
      <td width="75"><?php echo $music['favorite']?></td>

  </tr>


  <?php $index++;} ?>
</tbody>


</table>



    <div id="tailI" class="tailC">


    <audio id="audio" autoplay controls src ="music/Wood.mp3"></audio>




  <!--audio controls>
          <source id="source" src="" type="audio/mp3">
      </audio-->

    </div>
    <div id="faketail" class="tailC"></div>





  </body>

    <script language="javascript" type="text/javascript">



    //객체 생성
      //필요없는 메소드


      function play(tr){

        var rowCount = $('.tbody tr').length;
        //alert("플레이메소드");
        var index =tr.parentNode.parentNode.rowIndex-1; // 2
        //alert(index);

        var filename = document.getElementsByName('filename')[index].value;
        var title = document.getElementsByName('title')[index].value;
        //alert(title);

        $.ajax({

            data : {data : title, rowCount : rowCount},
            type: 'post',
            url: 'update_favorite.php',
            dataType: 'html',
            success: function(html) {
              $('.tbody').html(html);
                //$('.tr').hide();
            }
        });


     document.getElementById("audio").src = 'music/'+ filename;
        //alert(filename);
   var audiocontrol = document.getElementById("audio");
        //오디오 on/off 여부에 따라 시작 정지 결정
        if(audiocontrol.paused)audiocontrol.play();
       else audiocontrol.pause();

        //사용자가 음악을 들을때마다 들은 횟수가 올라간다.




      }//재생버튼 클릭이벤트 종료 괄호


//인피니티 스크롤 메소드 정의
      $(document).ready(function() {

        //아래로 스크롤하는 횟수를 세어
        var count = 0;
        //전체 데이터의 마지막행까지만 데이터를 요청한다.
        var data = <?php echo $row_num; ?>;
          var win = $(window);
          // Each time the user scrollss

          win.scroll(function() {
            //이곳에서 카운트하면 스크롤 움직일때마다 카운트 됨
              // End of the document reached?
              if ($(document).height() - win.height() == win.scrollTop()) {
                //alert("아래로 스크롤 하는거 인식");

                count+=5;
                //alert(count);
                  $('.table table-striped').show();

                  if(count<data){
                  $.ajax({

                      data : {param : count},
                      type: 'post',
                      url: 'my_music_infiniti.php',
                      dataType: 'html',
                      success: function(html) {
                        $('.tbody').append(html);
                          //$('.tr').hide();
                      }
                  });
                }//카운트 조건
              }
          });

      });






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
