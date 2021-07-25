<?php
include "data/db.php"; /* db load */

//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$idx = 10;

//dj랭킹 테이블로부터 10-30위 데이터를 들고온다.
$sql = mysqli_query($db, "SELECT * from dj_ranking limit 9, 21");
?>
<!--div class="banner" style="background-image: URL('https://s2.adform.net/Banners/32291072/32291072.jpg?bv=3')">

</div-->

<div>
<?php while($data = $sql->fetch_array()){ $img = $data['img']; $name = $data['name']; ?>

<div class="third" style="background-image: URL(<?php echo $img;?>); padding : 80px; float:left; ">
    <h3 class="text-center"><?php echo $idx."위   ".$name ?></h3>
  </div>
</div>

<?php $idx++;}?>
