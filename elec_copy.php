<?php
include "data/db.php"; /* db load */

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo $user_id;
$index = 1;

//아래로 스크롤링 할때 감지하여 카운트를 세는 전역 변수
//인피니티 스크롤 외에도, 좋아요 버튼이 눌렀을 때 태그에 들어가는 데이터를 리로드해야하는데
//현재 인피니티 스크롤로 불러온 데이터의 숫자가 몇개인지 알기위해 사용하는 변수
//취소 $count;


?>





<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
<title>#music_title</title>

  <meta charset="UTF-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>



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

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>





<body>


  <nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="main.php">MtG</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="navbar-collapse collapse" id="navbar-collapse-1">
	      <ul class="nav navbar-nav">
		<li class="active"><a href="free_board.php"> 게시판 <span class="sr-only">(current)</span></a></li>
		<li><a href="#">순위</a></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">음악장르<span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
		    <li><a href="#">Action</a></li>
		    <li><a href="#">Another action</a></li>
		    <li><a href="#">Something else here</a></li>
		    <li class="divider"></li>
		    <li><a href="#">Separated link</a></li>
		    <li class="divider"></li>
		    <li><a href="#">One more separated link</a></li>
		  </ul>
		</li>
	      </ul>
	      <form class="navbar-form navbar-left" role="search">
		<div class="form-group">
		  <input type="text" class="form-control" placeholder="Search">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
		<li><a href="#">Link</a></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">더보기 <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
		    <li><a href="#">Action</a></li>
		    <li><a href="#">Another action</a></li>
		    <li><a href="#">Something else here</a></li>
		    <li class="divider"></li>
		    <li><a href="#">Separated link</a></li>
		  </ul>
		</li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
         <!-- jumbotron -->
         <div class="container">
           <div class="jumbotron mt-3">
              <h1 class="text-center">Music to GoodTrip</h1>
               <p class="text-center">MtG와 떠나는 일렉여행</p>
             </div>
           </div>

  <div class="jumb" style="height:100% !important">
      <div class="container">
          <table class="table table-striped" >
              <thead>
              <tr>
                  <th width="50">번호</th>
                  <th width="450">곡명</th>
                  <th width="120">아티스트</th>
                  <th width="100">장르</th>
                  <th width="50">추천수</th>
                  <th width="50">재생</th>
                  <th width="50">담기</th>
              </tr>
              </thead>




  <?php


//변수는 다른 폴더에서 받아와서 사용해라

  $sql = mysqli_query($db, "SELECT * FROM music where genre='electronic' ");

  $row_num = mysqli_num_rows($sql); //장르별 총 저장된 음악 수

    $sql2 = mysqli_query($db,"select * from music where genre='electronic' order by idx asc limit 0, 5");

            //$start_num, $list
            //console.log($page);
            //console.log($sql2);
    //print_r ($page);
    //print_r ($sql2);

    //댓글db에 있는 데이터들을 가져와 행별로 출력한다.
    //while($reply = $sql3->fetch_array()){
    while($music = $sql2->fetch_array()){

      //$filename = $music['filename'];
  ?>
  <tbody class="tbody">
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
      <td width="50"><?php echo $music['recommend'];?></td>
      <td width="50"> <input type="button" value="재생" onclick="play(this);"></td>
      <!--아이디로 지정하면 하나의 행만 버튼이 인식됨. -->
      <!--td width="50"> <input type="button" value="재생" class="play"></td-->
      <td width="50"> <input type="button" value="담기" onclick="save(this);"></td>

  </tr>

</tbody>

  <?php $index++;} ?>
<tbody class="tbody" id="infiniti">
</tbody>

</table>



    <div id="tailI" class="tailC">
      <!--
     db에서 나온 곡의 목록에서 사용자가 재생버튼을 클릭하면
     해당 정보가 form으로 전달된다.
     그리고 해당곡이 틀어진다.


     <audio id="audio" autoplay controls src="music/<?php //echo $filename;?>"></audio>
       <input id="prev" type="button" value="<<" />
       <input id="play" type="button" value="||"/>
       <input id="next" type="button" value=">>"/>
       <input id="loop" type="button" value="@"/>
    -->
    <!--audio id="audio" autoplay controls src="<?php echo $path.$filename ?>">"></audio-->



<!--브라우저상에서 실행이되며 PHP 와 Http 서버가 필요함(디렉토리 인덱스 체크)-->

    <audio id="audio" autoplay controls src ="music/Wood.mp3"></audio>




  <!--audio controls>
          <source id="source" src="" type="audio/mp3">
      </audio-->

    </div>
    <div id="faketail" class="tailC"></div>





  </body>

    <script language="javascript" type="text/javascript">

/*
//테이블 내 열의 인덱스 얻기.
//음악리스트에서 사용자가 클릭한 리스트의 인덱스 번호를 받아 저장하고
//하단의 음악틀기 메소드를 통해 음악리스트의 인덱스상에 저장된 음악경로를 통해 음악을 킨다.
    function trClick(tr) {


        //alert("행 클릭 인식");
        var index = tr.rowIndex - 1;
        //alert('클릭한 TR index : ' + tr.rowIndex);
        var filename = document.getElementsByName('filename')[index].value;

      //alert('클릭한  index의 파일명 : ' + filename);


      $('.play').click(function() {

        //alert("플레이 버튼 인식");
        //alert(filename);

        document.getElementById("audio").src = 'music/'+ filename;
        var audiocontrol = document.getElementById("audio");
        //오디오 on/off 여부에 따라 시작 정지 결정
        if(audiocontrol.paused) audiocontrol.play();
        else audiocontrol.pause();



      });


            //음악 리스트상에서 담기버튼을 클릭하면 호출이 된다.
            $('.save').click(function() {

              //alert("담기 버튼 인식");

              //담기버튼을 클릭하면 실시간으로 사용자의 아이디와 사용자가 선택한 음악의 정보가
              //ajax를 통해 쿼리문을 실행하는 php로 보내지고,
              //쿼리문을 실행하는 php에서 중복검사 아이디를 찾고 아이디안에 이미 해당곡이 추가되었는지 여부를 확인하고
              //저장을 한다.

              var title = document.getElementsByName('title')[index].value;

              //var allData = {"id" : id, "title" : title};
              //alert('담기에 저장되는 모든데이터 : ' + title + id);


              $.ajax({

                  data : {data : title},
                  type: 'post',
                  url: 'save_my_music.php',
                  dataType: 'html',

              });





            });






    }//행클릭 인식 버튼
*/


    //객체 생성
      //필요없는 메소드


      function play(tr){


        var index =tr.parentNode.parentNode.rowIndex-1; // 2
        //alert(index);

        var filename = document.getElementsByName('filename')[index].value;
        document.getElementById("audio").src = 'music/'+ filename;
        alert(filename);
        var audiocontrol = document.getElementById("audio");
        //오디오 on/off 여부에 따라 시작 정지 결정
        if(audiocontrol.paused)audiocontrol.play();
        else audiocontrol.pause();

          //$path = 'music/';
          //$var = $_post["filename"];
          //  $var = 'music/Night_Ride.mp3';
          //var filename = $('[name="filename"]').attr('value');

        //  var select = document.querySelector('.td');
        //  var index = select.rowIndex;
          //var filename = document.getElementsByName('filename')[index].value;

        //  alert(index);
          //var myvar = 'music/Night_Ride.mp3';

          //document.getElementById("audio").src = 'music/Night_Ride.mp3';
          //document.getElementById("audio").src = 'music'+ filename;
          //console.log(document.getElementById("audio").src);





/*
          $.ajax({

          type: 'post', //post로
         url: 'ajax.php',
         data: { attr1: 'value1' },
         success: function( data ) {
             console.log(data);
             $('audio #source').attr('src', data);
             $('audio').get(0).load();
             $('audio').get(0).play();
         }
     });
*/

        }




//담기버튼

function save(tr){

    //인덱스번호를얻어
    //클릭한 행에 저장된 음악명을 받아와 변수에 저장후
    //ajax로 db작업을 하는 php 파일로 보낸다.

      var index =tr.parentNode.parentNode.rowIndex-1; // 2
      //alert(index);
        var title = document.getElementsByName('title')[index].value;
      alert(title);
                //var allData = {"id" : id, "title" : title};
                //alert('담기에 저장되는 모든데이터 : ' + title + id);


                $.ajax({
                    data : {data : title},
                    type: 'post',
                    url: 'save_my_music.php',
                    dataType: 'html',



                });

}





//인피니티 스크롤 메소드

$(document).ready(function() {

  //var count = 0;

  var data = <?php echo $row_num; ?>;
    var win = $(window);
    // Each time the user scrollss

    win.scroll(function() {
      //이곳에서 카운트하면 스크롤 움직일때마다 카운트 됨

        // End of the document reached?
        if ($(document).height() - win.height() == win.scrollTop()) {

          //count +=5;
          //alert(count);

          <?php $count +=5;?>
          var count = <?php echo $count; ?>;


            $('.table table-striped').show();

            if(count<data){
            $.ajax({
                data : {param : count},
                type: 'post',
                url: 'elec_infiniti.php',
                dataType: 'html',
                success: function(html) {
                    $('#infiniti').append(html);
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
</script>



</html>
