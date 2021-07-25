<?php
include "data/db.php"; /* db load */
//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
//ajax로 전달한 노래제목을 post로 받아, 변수에 저장한다.
$title = $_POST[title];
$count = $_POST[count];
//$genre = $_POST[genre];
$index =1;


//전달받은 데이터를 조건문으로 활용하여 디비로부터 데이터를 받아온다.
$check = mysqli_query($db,"SELECT * from music_like where user_id= '" . $user_id . "' and title= '" . $title . "' ");
//디비에서 받아온 데이터의 행을 세본다.
$row_num = mysqli_num_rows($check); //장르별 총 저장된 음악 수


//$hit = $hit['hit'] + 1;
//$fet = mysqli_query($db, "update free_board set hit = '" . $hit . "' where idx = '" . $idx . "'");




//위의 조건으로 저장된 데이터(즉 이미 좋아요를 누른) 여부를 저장하고
//조건문으로 저장이 되어있으면 삭제를 하고
//저장이 되어 있지 않으면 좋아요 정보를 추가한다.


//기존의 좋아요를 삭제하는 부분
if($row_num > 0){
  //이미 좋아요가 되어있으면,
  //좋아요 테이블에서 기존의 데이터를 삭제한다.
  //그리고 음악테이블에서 해당음악의 추천칼럼에 -1을 해준다.

  //좋아요 테이블에서 한 사용자의 해당 음악에 대한 추천을 삭제
  $lql = mysqli_query($db, "DELETE from music_like where user_id = '" . $user_id . "' and title = '" . $title . "' ");

  //음악 테이블에서 해당 음악의 추천수 칼럼에서 -1을 해준다.
  //해당음악의 추천수를 받아온다.
  $recommend = mysqli_fetch_array(mysqli_query($db,"SELECT * from music where title ='" . $title . "'"));
  $recommend = $recommend['recommend']-1;
  $mql = mysqli_query($db, "UPDATE music set recommend = '" . $recommend . "' where title ='" . $title . "'");

//좋아요가 추가되는 부분
}else{
  //위와 반대로 진행된다.
  $lql = mysqli_query($db, "INSERT into music_like (title, user_id) values ('$title','$user_id')");

  //음악 테이블에서 해당 음악의 추천수 칼럼에서 +1을 해준다.

  //해당음악의 추천수를 받아온다.
  $recommend = mysqli_fetch_array(mysqli_query($db,"SELECT * from music where title ='" . $title . "'"));
  $recommend = $recommend['recommend']+1;
  $mql = mysqli_query($db, "UPDATE music set recommend = '" . $recommend . "' where title ='" . $title . "'");


}




//좋아요 정보를 추가하거나 삭제가 끝난 뒤에
//
$mql = mysqli_query($db, "SELECT * FROM music where genre= 'reggae' order by recommend desc, title asc limit 0, $count");
//$mql = mysqli_query($db, "SELECT * FROM music where genre= '" . $genre . "' limit 0, $count");

//로그인한 아이디와 일치하는 데이터만 좋아요 테이블로부터 가져온다
$lql = mysqli_query($db, "SELECT * FROM music_like where user_id = '" . $user_id . "' ");

//좋아요에 저장된
while($row =  $lql->fetch_array()){

    $data[] = $row['title'];

  }

?>



  <?php
    while($music = $mql->fetch_array()){

      //$filename = $music['filename'];
  ?>

  <!--tr class="tr" onclick='javascript:trClick(this);'-->
  <tr class="tr" onclick='javascript:trClick(this);'>

    <td width="50"><?php echo $index?></td>
    <td width="50"><?php echo $music['title']?></td>
    <input type="hidden" name="title" value="<?php echo $music['title']; ?>" />
      <input type="hidden" name="filename" value="<?php echo $music['filename']; ?>" />
      <td width="120"><?php echo $music['artist']?></td>
      <td width="100"><?php echo $music['genre']?></td>
      <td width="50"><button  type="button" onclick="like(this);" style="width:20%;float:left"><img class="btn-img" src="<?php if(in_array($music['title'], $data)){echo "images/like.png";
    }else{echo "images/unlike.png";}?>"></button><h4 style="float:left; height:auto;"><?php echo $music['recommend']?></h4></td>
    <td width="50"> <input type="button" value="재생" onclick="play(this);"></td>
  <td width="50"> <input type="button" value="담기" onclick="save(this);"></td>

  </tr>


  <?php $index++;} ?>
