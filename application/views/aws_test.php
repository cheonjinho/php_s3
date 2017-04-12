<?php
	
?>

<!doctype html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>이미지 파일 업로드 테스트</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<h1>이미지 파일 업로드 테스트</h1>

	<table border="1">
		<tr>
			<th>이미지 파일</th>
			<th>이미지 제목</th>
			<th>이미지 메모</th>
		</tr>
		<tr>
			<td><input id="input_file" type="file"></td>
			<td><input id="input_title" type="text" placeholder="제목을 입력하세요"></td>
			<td><input id="input_memo" type="text" placeholder="메모를 입력하세요"></td>
		</tr>

	</table>
	<br>
	<button id="btn_upload" type="button">이미지 업로드 시작</button>


	<script>
		
		$(function()
		{
        /// 문서가 모두 로드되고나서 실행되는 스크립트

        $("#btn_upload").click(function(eventTarget)
        {



        	var inputFile = $("#input_file")[0].files[0];
        	var input_title = $("#input_title").val();
        	var input_memo = $("#input_memo").val();


            /// 파라미터 검사
            if(!inputFile)
            {
            	alert("파일을 넣어 주세요");
            	return ;
            }
            else if(input_title == "")
            {
            	alert("제목을 입력해 주세요");
            	return ;
            }else if(input_memo == "")
            {
            	alert("메모를 입력해 주세요");
            	return ;
            }


            /// 폼데이터의 생성
            var formDataObj = new FormData();
            formDataObj.append("input_file",inputFile);
            formDataObj.append("input_title",input_title);
            formDataObj.append("input_memo",input_memo);


            /// 네트워크 통신
            $.ajax({
            	url: "uploadfile.php",
            	type: "POST",
            	data : formDataObj,
            	cache: false,
							contentType: false,
							processData: false,
            	
            	success: function(data)
            	{
            		alert('success');

							},
							error:function(err)	{
								alert("err : "+err);
							},
								
							});



						});


	});
	</script>

</body>
</html>