<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>bxSlider</title>
<link href="jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="jquery.bxslider/jquery.bxslider.js"></script>
<style>
h1 {color:white;}
</style>
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
<!--
<div style="max-width:1000px;">
<ul class="bxslider">
    <li><img src="images/img01.jpg" title="캡션이 보여집니다." /></li>
    <li><img src="images/img02.jpg" title="캡션이 보여집니다." /></li>
    <li><img src="images/img03.jpg" title="캡션이 보여집니다." /></li>
    <li><img src="images/img04.jpg" title="캡션이 보여집니다." /></li>
</ul>
</div>
-->

<div style="max-width:1000px;">
<ul class="bxslider">
    <li>
        <div style="position:absolute;"><h1>첫 번째 이미지</h1></div>
        <img src="images/3191525.jpg" />
    </li>
    <li>
        <div style="position:absolute;"><h1>두 번째 이미지</h1></div>
        <img src="images/3192525.jpg" />
    </li>
    <li>
        <div style="position:absolute;"><h1>세 번째 이미지</h1></div>
        <img src="images/3192525.jpg" />
    </li>
    <li>
        <div style="position:absolute;"><h1>네 번째 이미지</h1></div>
        <img src="images/3192572.jpg" />
    </li>
</ul>
</div>

</body>
</html>
