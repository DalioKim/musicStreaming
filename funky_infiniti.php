<?php
include "data/db.php"; /* db load */
$count = $_POST['param'];
$index = $_POST['param']+1;
$user_id = $_SESSION[user_id];


?>



<?php


  $sql2 = mysqli_query($db,"SELECT * from music where genre='funky' order by recommend desc, title asc limit $count, 5");


  //로그인한 아이디와 일치하는 데이터만 좋아요 테이블로부터 가져온다
  $lql = mysqli_query($db, "SELECT * FROM music_like where user_id = '" . $user_id . "' ");

  //좋아요에 저장된
  while($row =  $lql->fetch_array()){

  		$data[] = $row['title'];

  	}

  //댓글db에 있는 데이터들을 가져와 행별로 출력한다.
  //while($reply = $sql3->fetch_array()){
  while($music = $sql2->fetch_array()){

    //$filename = $music['filename'];
?>
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
