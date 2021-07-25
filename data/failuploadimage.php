<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Start Up</title>

    <style type="text/css">

        input[type=file] {
            display: none;
        }

        .my_button {
            display: inline-block;
            width: 200px;
            text-align: center;
            padding: 10px;
            background-color: #006BCC;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }



        .imgs_wrap {

            border: 2px solid #A8A8A8;
            margin-top: 30px;
            margin-bottom: 30px;
            padding-top: 10px;
            padding-bottom: 10px;

        }
        .imgs_wrap img {
            max-width: 150px;
            margin-left: 10px;
            margin-right: 10px;
        }

    </style>

    <script type="text/javascript" src="./js/jquery-3.1.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">

        // 이미지 정보들을 담을 배열
        var sel_files = [];

        //변화를 감지
        $(document).ready(function() {
            $("#input_imgs").on("change", handleImgFileSelect);
        });

        //
        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function handleImgFileSelect(e) {

            // 이미지 정보들을 초기화
            sel_files = [];
            $(".imgs_wrap").empty();

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            var index = 0;

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
                    $(".imgs_wrap").append(html);
                    index++;

                }
                reader.readAsDataURL(f);

            });
        }



        function deleteImageAction(index) {
            console.log("index : "+index);
            console.log("sel length : "+sel_files.length);

            sel_files.splice(index, 1);

            var img_id = "#img_id_"+index;
            $(img_id).remove();
        }

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function submitAction() {
            console.log("업로드 파일 갯수 : "+sel_files.length);
            var data = new FormData();

            for(var i=0, len=sel_files.length; i<len; i++) {
                var name = "image_"+i;
                data.append(name, sel_files[i]);
            }
            data.append("image_count", sel_files.length);

            if(sel_files.length < 1) {
                alert("한개이상의 파일을 선택해주세요.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST","write_ok.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                    console.log("Result : "+e.currentTarget.responseText);
                }
            }

            xhr.send(data);

        }

    </script>
</head>

<body>



                     <div>
                         <h2><b>이미지 미리보기</b></h2>
                         <div class="input_wrap">
                             <a href="javascript:" onclick="fileUploadAction();" class="my_button">파일 업로드</a>
                             <input type="file" id="input_imgs" multiple/>
                         </div>
                     </div>

                     <div>
                         <div class="imgs_wrap">
                             <img id="img" />
                         </div>
                     </div>

                     <a href="javascript:" class="my_button" onclick="submitAction();">업로드</a>



</body>


</html>


<script>

    //그룹내에서 첫번쨰로 선택된 값을 리턴시켜줌
    var upload = document.querySelector('#upload');
    var preview = document.querySelector('#preview');

    upload.addEventListener('change',function (e) {

        //이미지를 초기화
        $("#preview").empty();

        //선택한 이미지를 변수에 저장
        var get_file = e.target.files;

        //docume
        var image = document.createElement('img');

        /* FileReader 객체 생성 */
        var reader = new FileReader();

        /* reader 시작시 함수 구현 */
        reader.onload = (function (aImg) {
            console.log(1);

            return function (e) {
                console.log(3);
                /* base64 인코딩 된 스트링 데이터 */
                aImg.src = e.target.result
            }
        })(image)

        if(get_file){
            /*
                get_file[0] 을 읽어서 read 행위가 종료되면 loadend 이벤트가 트리거 되고
                onload 에 설정했던 return 으로 넘어간다.
                이와 함게 base64 인코딩 된 스트링 데이터가 result 속성에 담겨진다.
            */
            reader.readAsDataURL(get_file[0]);
            console.log(2);
        }

        preview.appendChild(image);
    })
</script>
