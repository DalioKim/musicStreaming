<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>검색 순위</title>
<script type="text/javascript">
//페이지가 로드될때 기능을 실행
		window.onload = function (){

      //객체 가져오기
    var word = new Array();

    //랭킹id를 갖고 있는 요소에 접근
		var ranking = document.getElementById("ranking");

    //웹서버로부터 데이터 요청(ajax객체)
		var request = new XMLHttpRequest();

    //요청준비
		request.open("get","data/EX7_data.json",true);

    //데이터 요청
		request.send();

    //데이터 수신
		request.onreadystatechange = function(){
			if(request.readyState==4){
				if(request.status==200){
					var obj = JSON.parse(request.responseText); //json객체로 변환
					var str="";

					for(var i=0; i<4; i++){
            //str에 json으로부터 받아온 데이터와 순위를 저장해주고
            //다시 word배열에 str에 저장된 값을 하나씩 저장해준다.
						str = "["+(i+1)+"]"+obj.search_word[i].name;
						word[i] = str;		//str을 순서대로 배열 형태로 저장
					}
				}
			}
		}

    //검색어가 계속 처음부터 반복하기 위해 if i를 리셋해주는 메소드
	    var i=0;
		var interval = setInterval(function(){
			if(i>3){		//i가 3이상이되면 반복이 종료되므로
				i=0;		//다시 i를 0으로 초기화
			}
      //js객체에 배열의 데이터를 html형태로 저장해준다.
		 	ranking.innerHTML = "<h3>" + word[i] + "</h3>";
		  	i++;
		  }, 2000);			//2초마다 갱신

		  setTimeout(function(){
		   	   clearInterval(interval);
		  }, 20000); 		//20초후 정지
	}
</script>

<style type="text/css">    //스타일 지정
	table{
		text-align: center;
		border-collapse: collapse;
		width: 600px;
		height: 100px;
		background-color: green;
	}
	.td1{
		width: 400px;
		color: white;
	}
	.td2{width:200px;}
	div{
		background-color: white;
	}
</style>
</head>
<body>
	<h1>비동기 통신 결과</h1>
	<hr>
	<table border=1>
		<tr>
			<td class="td1"><h2>실시간 검색 순위</h2></td>
			<td class="td2"><div id="ranking"></div></td>
		</tr>
	</table>
</body>
</html>
