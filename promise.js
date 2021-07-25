


//랭커들의 상세정보 url주소를 담을 배열을 선언
var links = new Array();
//크롤링 관련 객체 선언
var cheerio = require('cheerio');
var request = require('request');
//스케쥴러 객체 선언
const schedule = require('node-schedule');

//랭커들의 상세페이지 url을 담을 배열 선언
var url_arr  = new Array();

//차트와 글을 담을 배열 선언
var chart_arr = new Array();
var text_arr = new Array();


//db에 접속해서 데이터를 받아온다.




        //1디비에서 받아온 url정보가 담긴 배열을 전달받으면,
        //2.반복문안에서 url주소로 접근하여, 태그정보를 크롤링한다.
        //3.그리고 태그정보를 배열에 담는다.
        var test = function(url_arr){
            return new Promise(function(resolve, reject){
                setTimeout( function(){
                    if(url_arr){
                      //디비접속

                      var mysql = require('mysql');
                      var connection = mysql.createConnection({
                          host     : 'localhost',
                          user     : '',
                          password : '',
                          database : 'web_page'
                      });

                        var sql = 'SELECT * FROM dj_ranking';
                        connection.query(sql, function(err, rows, fields){
                        	if(err){
                        		console.log(err);
                        	} else {


                        for(i=0; i<rows.length; i++){
                          url_arr[i] = rows[i].link;
                          console.log(url_arr[i]);
                        }
                        	}//조건문 종료괄호
                        });



                        resolve("배열길이: "+url_arr.length);
                    }
                    else{
                        reject("rejected 상태입니다. catch로 연결됩니다.");
                    }
                }, 1000)
            })
        }

        test(true)
        .then( function(result){
            console.log("1) " + result);
            return test(true);
        })
        .then( function(result){
            console.log("2) " + result);
            return test(false);
        })
        .then( function(result){
            console.log("3) " + result);
            return test(true)
        })
        .catch( function(result){
            console.log("4) " + result);
            return test(true)
        })
        .then( function(result){
            console.log("5) " + result);
            return test(true)
        })
