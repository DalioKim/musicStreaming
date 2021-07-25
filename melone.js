
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
var i = 1;
var j = 1;
var k = 1;

request(url, function(error, response, html){
  if (!error) {
    //cheerio를 통해 페이지의 전체 데이터를 가져온다.
    var $ = cheerio.load(html);
    //let article = $("article");




    //dj이름 파싱



  //1위부터 30위까지의 데이터를 파싱
   // dj이미지 파싱 후 저장

   //dj 이름 파싱

      //1.이미지태그와 2.dj이름이 있는 태그를 같이 놓고 each로 순서대로 파싱해간다.
      $('.top100dj-name > a').each(function(){

        //dj의 프로필이미지
       //var  img = $('.media--image_top100_no1--image_top100_no1').attr('src');
        //dj의 이름
        //var name = $('.top100dj-name > a').text().trim();

        //var name = $(this).children('a').text().trim();
        //names.push(article[i].children('a').eq(2))
        //imgs[i] = img;

        var name = $(this).text().trim();
        names[i] = name;
        console.log(i+"위"+  names[i]);

        i++
        if(i == 31){
          return false;
        }
        //쿼리문을 통해서 업데이트

        //var sql = 'UPDATE table SET img=?, name=? WHERE idx=?';
        //var params = [img, name, i];


      //  var sql = 'INSERT INTO dj_ranking(name,img)VALUES(?,?)';
    //    var params = [name,img];
      //  connection.query(sql,params,function(err,rows,fields) {
    //      if(err){
        //    console.log(err);
      //    }else{
      //      console.log(rows.insertId);
        //  }
      //  });
      })//파싱문 종료괄호




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

//sql문 시
      //var sql = 'INSERT INTO dj_ranking(name,img)VALUES(?,?)';
       //var params = [names[i],imgs[i]];
         //connection.query(sql,params,function(err,rows,fields) {
           //if(err){
         //console.log(err);
         //}else{
          // console.log(rows.insertId);
        // }
        //  });


        for (k = 1; k < 31; k++) {
          //var sql = 'INSERT INTO dj_ranking(idx,name,img)VALUES(?,?,?)';
           var sql = 'UPDATE dj_ranking SET name=?, img=? WHERE idx=?';
           var params = [k,names[k],imgs[k]];

             connection.query(sql,params,function(err,rows,fields) {
               if(err){
             console.log(err);
            }else{
               console.log(rows.insertId);
             }
             });

           }


  }
});

//크롤링으로 가지고 온 데이터를 반복문으로 디비에 업데이트 시킨다..
