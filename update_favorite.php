<?php

//사용자가 my music 페이지에서 자신이 선호하는 음악을 들을 때 마다
//해당음악의 선호도가 올라간다.
//이 선호도를 기준으로 페이징(인피니티 스크롤)이 된다.

include "data/db.php"; /* db load */

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
//ajax로 전달한 노래제목을 post로 받아, 변수에 저장한다.
$title = $_POST[data];
$count = $_POST[rowCount];
$index =1;
//$title = 'Girls Say';
//echo $user_id;
//echo $title;


error_reporting(E_ALL);

/*
$check = mysqli_query($db,"select * from my_music where id = '" . $user_id . "' and  title = '" . $title . "' ");
$hit = mysqli_fetch_array(mysqli_query($db,"select * from free_board where idx ='" . $idx . "'"));
$hit = $hit['hit'] + 1;
$fet = mysqli_query($db, "update free_board set hit = '" . $hit . "' where idx = '" . $idx . "'");
$sql = mysqli_query($db, "select * from free_board where idx='" . $idx . "'"); /* 받아온 idx값을 선택 */

$favorite = mysqli_fetch_array(mysqli_query($db,"select * from my_music where id ='" . $user_id . "' and title ='" . $title . "' "));
$favorite = $favorite['favorite'] + 1;
//echo $favorite;
$upt = mysqli_query($db, "UPDATE my_music set favorite = '" . $favorite . "' where id ='" . $user_id . "' and title ='" . $title . "' ");

//my_music에서 music으로 조인한 데이터를 가져온다.
$sql2 = mysqli_query($db, "SELECT *
    FROM my_music
       inner JOIN music ON my_music.title = music.title where my_music.id = '" . $user_id . "'
       order by favorite desc, music.title asc limit 0, $count;");
?>

<?php
  while($music = $sql2 ->fetch_array()){

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
