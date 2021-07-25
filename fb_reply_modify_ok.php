<?php
/*
include "data/db.php";
$rIdx = $_POST['rIdx'];
echo "댓글 인덱스: ".$rIdx;
echo "수정한 내용을 post로 받아온 값: ".$_POST['content'];
$content = $_POST['content'];
/*
$sql = mysqli_query($db,"select * from fb_reply where idx='".$rIdx."'");
$reply = $sql->fetch_array();
echo "댓글 인덱스: ".$rIdx;

$idx = $_POST['idx'];
$sql2 = mq("select * from free_board where idx='".$idx."'");
$board = $sql2->fetch_array();

$fet = mysqli_query($db, "update fb_reply set content = '" . $content . "' where idx = '" . $rIdx . "'");
//$sql3 = mysqli_query($db,"update fb_reply set content='".$_POST['content']."' where idx = '".$rIDx."'");
*/



	include "data/db.php";

	//세션에 저장된아이디를 통해 수정/삭제등의 권한과 관련된 기능여부를 결정.
	$user_id = $_SESSION[user_id];

	$idx = $_POST['idx'];
  $rIdx = $_POST['rIdx'];
  $content = $_POST['content'];
  $update_date = date("Y-m-d H:i:s");
	//echo $rIdx;
	//echo $content;




	$fet = mysqli_query($db, "update fb_reply set content = '" . $content . "' where idx = '" . $rIdx . "'");



?>
<script type="text/javascript" src="/js/common.js"></script>

<h3>댓글목록</h3>
	<?php


	//url을 통해 page의 값을 찾는다.

	//idx=4?page로 시도해봤는데도 실패
	if(isset($_GET['page'])){
			$page = $_GET['page'];
			//echo $page;
	}else{
		//없으면 1페이지
			$page = 1;
}


//  $sql = mysqli_query($db, "select * from free_board where idx='" . $idx . "'"); /* 받아온 idx값을 선택 */
//  $board = $sql->fetch_array();


//		$sql3 = mysqli_query($db, "select * from fb_reply where board_idx='".$idx."' order by idx desc");

		//해당 게시글의 총 댓글 수
		$sql = mysqli_query($db, "select * from fb_reply where board_idx='" . $idx . "'"); /* 받아온 idx값을 선택 */
		//$sql = mysqli_query($db, "SELECT * FROM fb_reply where board_idx = '" . $idx . "'");
		//오류나는 부분 : $sql = mq("select * from board");

		$row_num = mysqli_num_rows($sql); //해당 게시글의 댓글 총 레코드 수
		$list = 5; //한 페이지에 보여줄 개수
		$block_ct = 5; //블록당 보여줄 페이지 개수
		$block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
		$block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
		$block_end = $block_start + $block_ct - 1; //블록 마지막 번호
		$total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
		if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
		$total_block = ceil($total_page/$block_ct); //블럭 총 개수
		$start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

		//db로부터 시작지점부터 5개의 댓글데이터를 들고온다.


		$sql2 = mysqli_query($db,"select * from fb_reply where board_idx = '" . $idx . "' order by idx desc limit $start_num, $list");
						//$start_num, $list
						//console.log($page);
						//console.log($sql2);
		//print_r ($page);
		//print_r ($sql2);

		//댓글db에 있는 데이터들을 가져와 행별로 출력한다.
		//while($reply = $sql3->fetch_array()){
		while($reply = $sql2->fetch_array()){

			$reply_id = $reply['id'];
	?>
	<div class="dap_lo">
		<div><b><?php echo $reply['id'];?></b></div>
		<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
		<div class="rep_me dap_to"><?php echo $reply['create_date']; ?></div>
		<div class="rep_me rep_menu">

<?php if($user_id == $reply_id){?>
		<button type="suid"="rep_bt" class="dat_edit_bt">수정</button>
			<button type="suid"="rep_bt" class="dat_delete_bt">삭제</button>
	<?php  }?>



			<!--a class="dat_delete_bt" href="#">삭제</a-->
		</div>
		<!-- 댓글 수정 폼 dialog -->
		<div class="dat_edit">
			<form method="post">
				<!--form method="post" action="fb_reply_modify_ok.php"-->
				<input type="hidden" name="rIdx" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="idx" value="<?php echo $idx; ?>">
				<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
				<!--input type="submit" value="수정하기" class="re_mo_bt"-->
				<button type="button" class="re_mo_bt">수정하기</button>
			</form>
		</div>

		<!-- 댓글 삭제 비밀번호 확인 -->
					<div class='dat_delete'>
						<form method="post">
							<input type="hidden" name="rIdx" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="idx" value="<?php echo $idx; ?>">
							<button type="button" class="re_del_bt">삭제하기</button>
							<button type="suid"="rep_bt">돌아가기</button>

						 </form>
					</div>

	</div>
<?php } ?>


		<?php
		if($page <= 1)
		{ //만약 page가 1보다 크거나 같다면
				echo "처음"; //처음이라는 글자에 빨간색 표시
		}else{
				echo "<a href='?idx=$idx&page=1'>처음</a>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
		}
		if($page <= 1)
		{ //만약 page가 1보다 크거나 같다면 빈값
		}else{
				$pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
				echo "<a href='&page=$pre'>이전</a>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
		}
		for($i=$block_start; $i<=$block_end; $i++){
				//for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
				if($page == $i){ //만약 page가 $i와 같다면
						echo "[$i]"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
				}else{
						echo "<a href='?idx=$idx&page=$i'>[$i]</a>"; //아니라면 $i

				}
		}
		if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
		}else{
				$next = $page + 1; //next변수에 page + 1을 해준다.
				echo "<a href='idx=$idx&page=$next'>다음</a>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
		}
		if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
				echo "마지막"; //마지막 글자에 긁은 빨간색을 적용한다.
		}else{
				echo "<a href='idx=$idx&page=$total_page'>마지막</a>"; //아니라면 마지막글자에 total_page를 링크한다.
		}
		?>



	</div><!--- 댓글 불러오기 끝 -->


<!--- 댓글 입력 폼 -->
