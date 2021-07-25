<?php

    $host = 'localhost';
    $username = '';
    $password = '';
    $dbname = 'web_page';

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');



    try {

        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage());
    }


    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //오류보고에 사용
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //열의 이름으로써 배열을 리턴

    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        function undo_magic_quotes_gpc(&$array) {
            foreach($array as &$value) {
              //값이 벨류에 할당되고 벨류값이 1씩 상승하면서 배여을 반복
                if(is_array($value)) {
                  //변수가 배열인지 확인
                    undo_magic_quotes_gpc($value);
                    //설명 출처 : https://stackoverflow.com/questions/3508155/help-to-understand-magic-quotes-gpc

                }
                else {
                    $value = stripslashes($value);
                    //addslashes () 함수에 의해 추가 된 백 슬래시를 제거
            }
        }

        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
    }

    header('Content-Type: text/html; charset=utf-8');
    session_start();
?>
