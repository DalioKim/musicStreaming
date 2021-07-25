<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <title>Real-time Rank</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <!--head 부분에서
          1.css
        2.js(검색어 움직이는 부분)
      3.api를 상속받아서 사용하기로 정의-->
        <link href="stylesheet.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="application.js" type="text/javascript"></script>
        </head>
    <body>
        <div id="content">
            <dl id="rank-list">
                <dt>실시간 급상승 검색어</dt>
                <dd>
                    <ol>
                        <li><a href="#">1 순위</a></li>
                        <li><a href="#">2 순위</a></li>
                        <li><a href="#">3 순위</a></li>
                        <li><a href="#">4 순위</a></li>
                        <li><a href="#">5 순위</a></li>
                        <li><a href="#">6 순위</a></li>
                        <li><a href="#">7 순위</a></li>
                        <li><a href="#">8 순위</a></li>
                        <li><a href="#">9 순위</a></li>
                        <li><a href="#">10 순위</a></li>
                    </ol>
                </dd>
            </dl>
        </div>
    </body>
</html>
