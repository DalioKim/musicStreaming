<?php
include "data/db.php"; /* db load */
//세션의 유저아이디 변수에 저장된 값을 유저아이디에 저장한다.
$user_id = $_SESSION[user_id];
error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo $user_id.$user_id;
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>

    <!--링크 부분-->
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">







  </head>
<body>

  <?php include "navi.php"; /* navi load */
  ?>


<?php
//free_board php에서 게시글의 인덱스 번호를 받아온다.
$idx = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
$hit = mysqli_fetch_array(mysqli_query($db,"select * from free_board where idx ='" . $idx . "'"));
$hit = $hit['hit'] + 1;
$fet = mysqli_query($db, "update free_board set hit = '" . $hit . "' where idx = '" . $idx . "'");
$sql = mysqli_query($db, "select * from free_board where idx='" . $idx . "'"); /* 받아온 idx값을 선택 */
$board = $sql->fetch_array();
//db에 저장한 파일명들을 split 해주는 부분
//1.저장된 파일이 있는지 체크하고
//2.db에 구분자를 포함하여 저장한 파일명을 변수에 옮기고
//3.구분자를 split해줘서 array에 저장해준다.
//4.html 부분에서 array의 길이만큼 이미지를 출력한다.
//echo $board[filename];
if(!empty($board[filename])){
$array = explode("/", $board[filename]);
//echo $array[0];
//echo $array[1];
//echo $array[2];
}
?>
<!-- 글 불러오기 -->
<div id="board_read">
  <h2><?php echo $board['title']; ?></h2>
  <div id="user_info">
      <?php echo $board['id']; ?> <?php echo $board['create_date']; ?> 조회:<?php echo $board['hit']; ?>
      <div id="bo_line"></div>
  </div>
  <div id="bo_content">
    <?php
    for($i = 0; $i < count($array); $i++) {
      echo "<img src='upload/images/$array[$i]'/>";
     }
     echo "<br/>";
       echo nl2br("$board[content]"); ?>
  </div>
  <!-- 목록, 수정, 삭제 -->
  <div id="bo_ser">
    <ul>
      <li><a href="/">[목록으로]</a></li>
      <li><a href="free_modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
      <li><a href="free_delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
    </ul>
  </div>

  <!--- 댓글 불러오기 -->
  <div class="reply_view">
  	<h3>댓글목록</h3>
  		<?php
      //url을 통해 page의 값을 찾는다.
      //idx=4?page로 시도해봤는데도 실패
      if(isset($_GET['page'])){
          $page = $_GET['page'];
          echo $page;
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
        <button type="button" class="dat_edit_bt">수정</button>
          <button type="button" class="dat_delete_bt">삭제</button>
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
            echo "<a href='?idx=$idx&page=$pre'>이전</a>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
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



  <div class="dap_ins">
    <form method="post" class="reply_form">
      <input type="hidden" name="idx" value="<?php echo $idx; ?>">
      <input type="text" name="id" id="dat_user" size="15" value="<?php echo $user_id; ?>">
      <div style="margin-top:10px; ">
        <textarea name="content" class="reply_content" id="re_content"></textarea>

        <!--
        re_bt클래스에 의해 버튼 클릭을 인식하면
        js/common.js에 정의한 ajax 코드가 호출
        ajax를 통해 댓글을 db로 저장시키는 php파일로 데이터를 성공적으로 보내면,
        댓글이 db에 등록됨과 동시에 변경된 데이터가 뷰에 반영된다.
      -->

        <button type="button" id="re_bt">입력</button>
      </div>
    </form>
  </div>


  <div id="foot_box"></div>
  </div>


</body>

<script>
//댓글 ajax 처리부분
//등록부분
//버튼중복처리를 막는데 사용하는 변수
//$(document).ready(function(){
  //댓글버튼 클릭이 인식되면
  //var isAjaxing = false;
  $(document).on("click","#re_bt",function(){
	//$(".re_bt").click(function(){
    console.log("등록 메소드 시작")


//$(document).on("click",".re_bt",function(){
    //ajax 전송시 중복 클릭문제
  //  if(isAjaxing){
    //  return;
    //}
    //isAjaxing = true;
    //댓글창에 입력된 데이터를 묶어주고
		//var regist = $("form").serialize();
    var regist = 	$(".reply_content").val();
    var idx = <?php echo $board["idx"]; ?>;
    console.log("폼에 담긴 값:"+regist)
    //비동기통신을 이용하여
				$.ajax({
					type: 'post', //post로
					url: 'fb_reply_ok.php?=<?php echo $board["idx"]; ?>', //댓글db 저장을 처리해주는 php로 보낸다.
    //get으로 게시글의 idx를 받게끔 해준다.
        	data : {content:regist,idx:idx},
					dataType : 'html',
				success: function(data){
            //데이터 전송이 성공적으로 끝나면
            //다시 db로부터 데이터를 받아와
            //데이터를 뷰에 뿌려준다.
						$(".reply_view").html(data);
						$("#re_content").val('');
            //success에 form 리셋을 넣으면 댓글이 여러개 달리는 문제가 발생
          //  setTimeout(function(){
            //  isAjaxing =false;},10000);
					}
          //이 부분에 넣어주면 데이터 자체가 리셋되어 전송이 안됨
				});
        //ajax 리로드 방지용
        //문제가 발생하여 주석처리
        //return false;
        //form상의 중복데이터를 없애기 위해 리셋을 해준다.
        //여기도 여러개 달리는 문제가 발생
        //이거의 문제가 아닌듯
      //$(".reply_form")[0].reset();
			});
      //댓글 ajax 처리부분
      //수정부분
      //동적태그를 위한 클릭메소드 수정
      $(document).on("click",".re_mo_bt",function(){
        //$(".re_mo_bt").click(function(){

        //다이얼로그 강제종료
        //$("#id").dialog("close") - 다이얼로그를 화면상에서 보이지 않게함
      //  var obj = $(this).closest(".dap_lo").find(".dat_edit");
        //obj.dialog('close');
        //obj.$('.dat_edit').dialog('destroy').remove();
        $(this).closest('.ui-dialog-content').dialog('close');
      //$(".re_mo_bt").click(function(){
        //수정된 댓글창에 입력된 데이터를 묶어주고
        console.log("수정메소드 시작")
    		var modify = $("form").serialize();
        //비동기통신을 이용하여
    				$.ajax({
    					type: 'post', //post로
    					url: 'fb_reply_modify_ok.php?=<?php echo $board["idx"]; ?>', //댓글db 저장을 처리해주는 php로 보낸다.
    					data : modify,
    					dataType : 'html',
    					success: function(data){
                //데이터 전송이 성공적으로 끝나면
                //다시 db로부터 데이터를 받아와
                //데이터를 뷰에 뿌려준다.
    						$(".reply_view").html(data);
    						$("#re_content").val('');
    					}

    				});
            //ajax 리로드 방지용
            //을 사용하려고 했으나, 화면에 제대로 반영되지 않음....
            //return false;
    			});
          $(document).on("click",".re_del_bt",function(){
        //  $(".re_del_bt").click(function(){
            //다이얼로그를 강제종료하고
            $(this).closest('.ui-dialog-content').dialog('close');
            //댓글창에 입력된 데이터를 묶어주고
            var params = $("form").serialize();
            //비동기통신을 이용하여
                $.ajax({
                  type: 'post', //post로
                  url: 'fb_reply_delete_ok.php?=<?php echo $board["idx"]; ?>', //댓글db 삭제를 처리해주는 php로 보낸다.
            //get으로 게시글의 idx를 받게끔 해준다.
                  data : params,
                  dataType : 'html',
                  success: function(data){
                    //데이터 전송이 성공적으로 끝나면
                    //다시 db로부터 데이터를 받아와
                    //데이터를 뷰에 뿌려준다.
                    $(".reply_view").html(data);
                    $("#re_content").val('');
                  }
                });
                //ajax 리로드 방지용
              //  return false;
              });
//다이얼로그 이벤트
      //댓글수정버튼(.dat_edit_bt)을 누르면
      //해당 메소드가 호출
    //$(".dat_edit_bt").click(function(){
    //동적태그에 대한 이벤트 클릭인식
        $(document).on("click",".dat_edit_bt",function(){
/*
          $(".dat_edit").dialog({ // dia_rs를 dialog오버레이창의로 띄워주고 'dialog창'이라는 제목과 넓이 800을 설정합니다
				title : "dialog 창",
				width : 800,
				modal : true, //dialog창이 올라왔을 때 dialog이전 레이어(즉 dialog창뒤에 있는것)을 보호할것인가 하지않을것이가 정합니다
			});
      */
      var obj = $(this).closest(".dap_lo").find(".dat_edit");
      //console.log("메소드 호출");
      //this는 나 자신을 의미, closet은 선택자 기준으로 가장 가까운 곳을 찾음
      //.closet.find("")를 사용, 가까운 상위에서 아래로 내려가서 찾는 방식
      //수정버튼을 클릭했을때, 댓글을 보여주고 있던 곳에서 수정입력창을 띄어주는 것
      obj.dialog({
        modal:true,
        width:650,
        height:200,
        title:"댓글 수정"});
})
      //  function edit(){
      			//var obj = $(this).closest(".dap_lo").find(".dat_edit");
            //console.log("메소드 호출");
            //this는 나 자신을 의미, closet은 선택자 기준으로 가장 가까운 곳을 찾음
            //.closet.find("")를 사용, 가까운 상위에서 아래로 내려가서 찾는 방식
            //수정버튼을 클릭했을때, 댓글을 보여주고 있던 곳에서 수정입력창을 띄어주는 것
            /*
            obj.dialog({
      				modal:true,
      				width:650,
      				height:200,
      				title:"댓글 수정"});
              */
        //}
	//$(".dat_delete_bt").click(function(){
  $(document).on("click",".dat_delete_bt",function(){
		var obj = $(this).closest(".dap_lo").find(".dat_delete");
		obj.dialog({
			modal:true,
			width:400,
      height:100,
			title:"댓글 삭제확인"});
		});
//});
</script>


</html>
