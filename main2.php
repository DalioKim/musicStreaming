


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>웹 페이지 레이아웃</title>

    <!--head 부분에서

    2.js(검색어 움직이는 부분)
    3.api를 상속받아서 사용하기로 정의-->
    <link href="stylesheet.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script src="application.js" type="text/javascript"></script>


    <!--jquery부분-->
    <link href="jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="jquery.bxslider/jquery.bxslider.js"></script>

    <!--부트스트랩 링크-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <style>
        *{
          /*화면에 꽉차게 해주는 명령어*/
          margin: 0px;
             padding: 0px;
        }
        html,body{
          /*body에서 설정해줘야 화면의 모든 높이를 활용할 수 있다.*/
          height: 100%;
        }
        .Header{
            line-height: 150px;
            width: 100%;
            padding: 0;
            margin: auto;

                      }
        .Nav{
            height : 25px;
            width: 100%;
            border-bottom: 3px solid gold
        }
        .Content{
          width: 100%;
            height : 420px;
            display: block;
            clear: both;
        }
        .Footer {
            height : 55px;
            line-height : 55px;
        }
        ul {
            list-style: none;
            padding-left : 0px;
        }

        .logo{
            display: inline;
            width: 100px;
            height: 100px;
        }

        .search_bar{
            width: 200px;
            height: 100px;
            display: inline-block;
            border: 0px;
            padding: 20px;

        }



        .form{
        width: 200px;
        display: inline-block;
        border: 0;

        }
        /*검색창 */
        .input:-ms-input-placeholder{color:#a8a8a8;}

        .input{

        font-size: 16px;
        width: 200px;
        padding: 10px;
        outline: none;
        display: inline-block;

        }
        /*검색창 버튼*/
        .button{
        width: 50px;
        border:  0px
        background: #1b5ac2;
        outline:  none;
        float:  right;
        color: #ffffff

        }


        .keyword{
            width: 200px;
            display: inline-block;
        }

        #keyword icon{
          width: 100px;
          display: block;
        }


        /*급상승로고  css*/
        a{
          color: #1a1a1a;
          text-decoration: none;
        }

        h1{
          display: block;
        }

        h1 {color:white;}

/*메뉴바 */
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        ul:after{
            content:'';
            display: block;
            clear:both;
        }
        li {
            float: left;
        }
        li a {
            display: block;
            color: black;
            text-align: center;
            padding: 0px 60px ;
            text-decoration: none;
        }
        li a:hover:not(.active) {
          background-color: #4CAF50;
        }
        .active {
            background-color: #4CAF50;
        }

        /*앨범*/
        div.gallery {
          margin: 5px;
          border: 1px solid #ccc;
          float: left;
          width: 180px;
        }

        div.gallery:hover {
          border: 1px solid #777;
        }

        div.gallery img {
          width: 100%;
          height: auto;
        }

        div.desc {
          padding: 15px;
          text-align: center;
        }


    </style>

<!--이미지 슬라이드 js-->
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	//$('.bxslider').bxSlider();

     $('.bxslider').bxSlider({
        auto: true,
        speed: 500,
        pause: 4000,
        mode:'fade',
        autoControls: true,
        pager: true,
    });
});
//]]>
</script>



</head>
<body>
    <div class = "Header">
      <!--로고-->
      <div class="logo">LoyalSound</div>

      <!--검색창-->
      <div class="search_bar">

        <form>

        <input type="text" placeholder="검색어 입력">
        <button>검색</button>

      </form>

      </div>






      <!--실시간 검색순위 타이틀-->
      <div class="keyword">
        <div id="content">
          <dl id="rank-list">
              <dt>실시간 급상승 검색어</dt>
              <dd>
                  <ol>
                      <li><a href="#">임창정</a></li>
                      <li><a href="#">코요테</a></li>
                      <li><a href="#">박명수</a></li>
                      <li><a href="#">이수</a></li>
                      <li><a href="#">터보</a></li>
                      <li><a href="#">핑클</a></li>
                      <li><a href="#">젝스키스</a></li>
                      <li><a href="#">HOT</a></li>
                      <li><a href="#">핑클</a></li>
                      <li><a href="#">GOD</a></li>
                  </ol>
              </dd>
          </dl>


      </div>

    </div>

      <!--로그인 입력창 -->

      <div>


        <button onclick="location.href='./login.php'">로그인</button>

      </div>



</div>


    <div class = "Nav">
      <ul>
  <li><a href="#news">음악차트</a></li>
  <li><a href="#news">최신</a></li>
  <li><a href="#news">장르</a></li>
  <li><a href="#news">DJ소개</a></li>
  <li><a href="#contact">매거진</a></li>
  <li><a href="#contact">게시판</a></li>
  <li><a href="#about">About</a></li>
</ul>
    </div>
    <div class = "Content">
      <ul class="bxslider">

        <!--li가 div에 정의한 내용에 의해 우선 적용받는 것은 확인
        하지만 left 700으로 하니까 하단으로 밀려난다.
      img는 div에 묶인게 아니라 별개이기때문에 div의 크기때문에 밀려남 -->
          <li>
              <img src="images/3191525.jpg" style="width : 70%; height : 400px; margin : auto;"/>
          </li>
          <li>
              <img src="images/3192525.jpg" style="width : 70%; height :400px; margin : auto;"/>

          </li>
          <li>
              <img src="images/3192525.jpg" style="width : 70%; height : 400px; margin : auto;"/>
          </li>
          <li>
              <img src="images/3192572.jpg" style="width : 70%; height : 400px; margin : auto;"/>
          </li>
      </ul>
    </div>

    <div class = "Footer">

        Footer 영역
    </div>
</body>
</html>
