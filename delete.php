<?php
include "data/db.php";

$idx = $_GET['idx'];





//수정 $fet = mysqli_query($db, "update fb_reply set content = '" . $content . "' where idx = '" . $rIdx . "'");
$sql = mysqli_query($db, "delete from free_board where idx = '" . $idx . "'");



?>

<script>
location.replace('free_board.php') 

</script>
