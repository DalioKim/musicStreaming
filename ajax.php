<?php
	include "data/db.php";

	$idx = $_POST['idx'];
  $date = date("Y-m-d H:i:s");
	$user_id = $_SESSION[user_id];


	$sql = mysqli_query($db,"insert into fb_reply(board_idx,id,content,create_date) values('".$idx."','".$_POST['id']."','".$_POST['content']."','".$date."')");
?>
