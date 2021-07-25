
//검색어를 움직여주는 js부분
$(function() {
  //dl tag 데이터의 길이와 css상의 정의된 높이값을 가져와 각각의 변수에 저장시킨다.
    var count = $('#rank-list li').length;
    var height = $('#rank-list li').height();

//검색어 순위를 움직이는 메소드
//메소드 내부의 로직은 아직 공부안함 
    function step(index) {
      //2초마다 움직인다.
        $('#rank-list ol').delay(2000).animate({
            top: -height * index,
        }, 500, function() {
            step((index + 1) % count);
        });
    }

    step(1);
});
