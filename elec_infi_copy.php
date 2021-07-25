<?php
include "data/db.php"; /* db load */
$count = $_POST['param'];
$index = $_POST['param']+1;


?>



<?php


  $sql2 = mysqli_query($db,"select * from music where genre='electronic' order by idx asc limit $count, 5");
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
<tr class="tr" onclick='javascript:trClick(this);'>
  <td width="50"><?php echo $index?></td>
  <td width="50"><?php echo $music['title']?></td>
  <input type="hidden" name="title" value="<?php echo $music['title']; ?>" />
    <input type="hidden" name="filename" value="<?php echo $music['filename']; ?>" />
    <td width="120"><?php echo $music['artist']?></td>
    <td width="100"><?php echo $music['genre']?></td>
    <td width="50"><?php echo $music['recommend'];?></td>
    <td width="50"> <input type="button" value="재생" onclick="play(this);"></td>

    <td width="50"> <input type="button" value="담기" onclick="save(this);"></td>

</tr>


<?php $index++;} ?>
