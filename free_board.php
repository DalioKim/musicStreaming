
<?php

include 'data/db.php';
header("Content-Type:text/html;charset=utf-8");

 ?>
    <!DOCTYPE html>
    <html lang ="ko">
    <head>
      <meta charset="UTF-8">
        <title> 자유 게시판 </title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Custom styles for this template -->


        <style>

        *{
          /*화면에 꽉차게 해주는 명령어*/
          margin: 0px;
             padding: 0px;
        }
        html,body{
          /*body에서 설정해줘야 화면의 모든 높이를 활용할 수 있다.*/
          height: 100%;
        }




            #page_num {
                font-size: 14px;
                margin-left: 260px;
                margin-top:30px;
            }
            #page_num ul li {
                float: left;
                margin-left: 10px;
                text-align: center;
            }
            .fo_re {
                font-weight: bold;
                color:red;
            }



        </style>



    </head>

    <body>

      <?php include "navi.php"; /* navi load */
      ?>

    <div class="jumbotron" style="height:1000px !important">
        <div class="container">
            <table class="table table-striped" >
                <thead>
                <tr>
                    <th width="50">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="50">조회수</th>
                    <th width="50">추천수</th>
                </tr>
                </thead>
                <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }

                $sql = mysqli_query($db, "SELECT * FROM free_board");
                //오류나는 부분 : $sql = mq("select * from board");
                $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
                $list = 5; //한 페이지에 보여줄 개수
                $block_ct = 5; //블록당 보여줄 페이지 개수
                $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
                $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                $block_end = $block_start + $block_ct - 1; //블록 마지막 번호
                $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
                if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                $total_block = ceil($total_page/$block_ct); //블럭 총 개수
                $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.
                $sql2 = mysqli_query($db,"select * from free_board order by idx desc limit $start_num, $list");


                while($board = $sql2->fetch_array()){
                    $title=$board["title"];
                    $idx = $board["idx"];
                    if(strlen($title)>50)
                    {
                      //글 제목이 30자가 넘을시 ...처리
                        $title=str_replace($board["title"],mb_substr($board["title"],0,50,"utf-8")."...",$board["title"]);
                    }

                    //댓글 카운트를 해준다.
                    $sql3 = mysqli_query($db,"select * from fb_reply where board_idx='".$idx."'"); //reply테이블에서 con_num이 board의 idx와 같은 것을 선택
                  $rep_count = mysqli_num_rows($sql3); //num_rows로 정수형태로 출력

                    $comment = $board['comment'];
                    echo $recommend;
                    ?>
                    <tbody>
                    <tr>
                        <td width="50"><?php echo $board['idx']; ?></td>
                        <td width="500">

        <a href='free_read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; ?><span style="font-weight:bold; color:blue;">[<?php echo $rep_count; ?>]</span></a></td>
                        <td width="120"><?php echo $board['id']?></td>
                        <td width="100"><?php echo $board['create_date']?></td>
                        <td width="50"><?php echo $board['hit']?></td>
                        <td width="50"><?php echo $board['recommend']?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td colspan=4 align=center>

                        <?php
                        if($page <= 1)
                        { //만약 page가 1보다 크거나 같다면
                            echo "처음"; //처음이라는 글자에 빨간색 표시
                        }else{
                            echo "<a href='?page=1'>처음</a>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
                        }
                        if($page <= 1)
                        { //만약 page가 1보다 크거나 같다면 빈값
                        }else{
                            $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                            echo "<a href='?page=$pre'>이전</a>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                        }
                        for($i=$block_start; $i<=$block_end; $i++){
                            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                            if($page == $i){ //만약 page가 $i와 같다면
                                echo "[$i]"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                            }else{
                                echo "<a href='?page=$i'>[$i]</a>"; //아니라면 $i
                            }
                        }
                        if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                        }else{
                            $next = $page + 1; //next변수에 page + 1을 해준다.
                            echo "<a href='?page=$next'>다음</a>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                        }
                        if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
                            echo "마지막"; //마지막 글자에 긁은 빨간색을 적용한다.
                        }else{
                            echo "<a href='?page=$total_page'>마지막</a>"; //아니라면 마지막글자에 total_page를 링크한다.
                        }
                        ?>


                    <td/>
                    </tr>
                    </tbody>
                <!--원래는 tbody뒤에 php괄호 종료-->

            </table>


    <div class="container">
        <form class="navbar-form navbar-right" method=POST action=write.php>
            <button type="submit" onclick="location.href='write.php'" class="btn btn-success">글쓰기</button>
        </form>
    </div>


    </body>
    </html>
