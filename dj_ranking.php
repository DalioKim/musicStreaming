<?php
include "data/db.php"; /* db load */

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo $user_id;


$idx = 2;
//Dj랭킹 테이블로부터 1위 데이터를 들고온다.
$sql = mysqli_fetch_array(mysqli_query($db,"SELECT * from dj_ranking where idx ='1'"));
$first_img = $sql['img'];
$first_name = $sql['name'];

//dj랭킹 테이블로부터 2-9위 데이터를 들고온다.
//idx번호가 아니라 실제 인덱스 번호로 가져오기떄문에 혼동조심
$second_sql = mysqli_query($db, "SELECT * from dj_ranking limit 1, 8");



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
</head>

<style>

.first{
  background-size: cover;
  text-shadow: black 0.2em 0.2em 0.2em;
  color: white;
  width: 1000px;
  height: 800px;
  border: 5px solid grey;
  border-radius: 50px;
  padding-bottom: 30px;
}

.second {
  background-size: cover;
  text-shadow: black 0.2em 0.2em 0.2em;
  color: white;
  width: 500px;
  height: 400px;
  border: 5px solid grey;
  border-radius: 50px;
  padding-bottom: 30px;

}

.third{
  background-size: cover;
  text-shadow: black 0.2em 0.2em 0.2em;
  color: white;
  width: 350px;
  height: 300px;
  border: 5px solid grey;
  border-radius: 50px;
  padding-bottom: 30px;

}





.jumbotron {
  background-image: url("images/flume2.jpg");
  background-size: cover;
  text-shadow: black 0.2em 0.2em 0.2em;
  color: white;
  height: 200px;
  padding-bottom: 30px;

}

</style>



<body>

  <?php include "navi.php"; /* navi load */
  ?>

  <!-- jumbotron -->
  <div class="container" style="  padding-bottom: 30px !important">
    <div class="jumbotron mt-3">
       <h1 class="text-center">Dj랭킹</h1>
      </div>
    </div>



    <!--div캘르사안에 패딩을 주면 h1이 패딩에 영향을 받는다.-->
    <div class="container" style="  padding-bottom: 30px !important">
    <div class="first" style="background-image: URL(<?php echo $first_img;?>)">
        <h1 class="text-center"><?php echo "1위   ".$first_name ?></h1>
      </div>
    </div>



  <!--중간 배너 -->
  <div>

  </div>

<!--2위부터 9위까지-->
<div class="container" style="  padding-bottom: 30px !important">
  <div>

    <?php while($data = $second_sql->fetch_array()){ $img = $data['img']; $name = $data['name']; ?>

    <div class="second" style="background-image: URL(<?php echo $img;?>); float:left; ">
        <h2 class="text-center"><?php echo $idx."위   ".$name ?></h2>
      </div>


      <!--div class="sec_rank" style="float:left;">
      <img style="width : 500px; padding : 10px 10px 0px 10px;" <?php    echo "src='$img'";?> />
      <h1><?php //echo $idx."위   ".$name ?></h1>
    </div-->
    <?php $idx++;}?>
  </div>
</div>

<div class="container">
  <div id="infiniti">
  </div>
</div>


</body>

  <footer>
    <img src =""/>
  </footer>

  <script language="javascript" type="text/javascript">

  var count = 0;


  //인피니티 스크롤 메소드

  $(document).ready(function() {

      var win = $(window);
      // Each time the user scrollss

      win.scroll(function() {

          if ($(document).height() - win.height() == win.scrollTop()) {
            //이곳에서 카운트하면 스크롤 움직일때마다 카운트 됨
            //alert("스크롤인식");

            if(count<1){
              count++;

              $.ajax({
                  url: 'dj_infiniti.php',
                  dataType: 'html',
                  success: function(html) {
                      $('#infiniti').append(html);
                  }
              });

            }

          }
      });

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
