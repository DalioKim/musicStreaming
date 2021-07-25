<?php
include "data/db.php"; /* db load */
$count = $_POST['param'];
$index = $_POST['param']+1;
$user_id = $_SESSION[user_id];
//echo $count;









  //$sql2 = mysqli_query($db,"select * from my_music  order by favorite desc limit $count, 5");


  $sql2 = mysqli_query($db, "SELECT *
      FROM my_music
         inner JOIN music ON my_music.title = music.title where my_music.id = '" . $user_id . "'
         order by favorite desc, music.title asc limit $count, 5;");



  while($music = $sql2->fetch_array()){

    //$filename = $music['filename'];
?>
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
