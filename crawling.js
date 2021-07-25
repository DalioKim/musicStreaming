
//디비접속
var mysql = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : '',
    password : '',
    database : 'web_page'
});
//디비접속여부 확인
connection.connect(function(err) {
  if (err) {
    console.error('error connecting: ' + err.stack);
    return;
  }

  console.log('connected as id ' + connection.threadId);
});

var cheerio = require('cheerio');
var request = require('request');


var url = 'https://djmag.com/top100djs';
var imgs = new Array();
var names = new Array();
var links = new Array();

//반복문에 사용할 변수들을 선언
var i = 1;
var j = 1;
var k = 1;
var idx = 1;

request(url, function(error, response, html){
  if (!error) {
    //cheerio를 통해 페이지의 전체 데이터를 가져온다.
    var $ = cheerio.load(html);
    //let article = $("article");


    //랭커의 이름 파싱
    $('.top100dj-name > a').each(function(){

      var name = $(this).text().trim();
      names[i] = name;
      console.log(i+"위"+  names[i]);

      i++
      if(i == 31){
        return false;
      }

    })//파싱문 종료괄호



   //랭커의 이미지 파싱
    $('.media--image_top100_no1--image_top100_no1').each(function(){
      var img = $(this).attr('src');

      //console.log(img);
      imgs[j] = img;
      console.log(j+"위"+  imgs[j]);
      j++
      if(j == 31){
        return false;

      }

    })//파싱문 종료괄호

          //dj랭커의 사진을 클릯시 상세정보를 나타내는 페이지로 이동하는 url 정보를 파싱
            $('.top100dj-name > a').each(function(){
              var link = $(this).attr('href');

              links[idx] = link;
              console.log(idx+"위"+  links[idx]);

              idx++
              if(idx == 31){
                return false;
              }

            })//파싱문 종료괄호


            for (k = 1; k < 31; k++) {

              //데이터 최초저장
              //var sql = 'INSERT INTO dj_ranking(idx,name,img,link)VALUES(?,?,?,?)';
              //var params = [k,names[k],imgs[k],links[k]];

              //업데이트
               var sql = 'UPDATE dj_ranking SET name=?, img=?, link=? WHERE idx=?';
               var params = [names[k],imgs[k],links[k],k];

                 connection.query(sql,params,function(err,rows,fields) {
                   if(err){
                 console.log(err);
                }else{
                   console.log(rows.insertId);
                 }
                 });

               }












  }   //전체종료괄호
});
