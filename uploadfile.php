<?php
	require 'application/aws/aws-autoloader.php';
  use Aws\S3\S3Client;

  $input_file = $_FILES["input_file"];
  $input_memo =  $_POST["input_memo"];
  $input_title =  $_POST["input_title"];

  if($input_file && $input_memo && $input_title) {
		/// 업로드 가능한 파일 검사 --> 이미지
  	$validextensions = array("jpeg", "jpg", "png");
  	$temporary = explode(".", $input_file["name"]);
  	$file_extension = end($temporary);
    // 현재 타임존 설정
  	date_default_timezone_set('Asia/Seoul');
    /// 타임스탬프 얻어옴
  	$date = new DateTime();
  	$timeStamp = $date->getTimestamp();
    /// 파일 타입이 이미지인지 검사
  	if ((($input_file["type"] == "image/png") || ($input_file["type"] == "image/jpg") || ($input_file["type"] == "image/jpeg"))  && in_array($file_extension, $validextensions)) {
        /// 에러인지 검사
  		if ($input_file["error"] > 0) {
  			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
  		}	else {
            /// 파일 저장할 디렉토리가 없다면 생성
  			if (!file_exists(getcwd()."/temp_image/")) {
  				mkdir(getcwd()."/temp_image/", 0777, true);
    		}
    		
  			if (file_exists(getcwd()."/temp_image/" . $input_file["name"].$timeStamp)) {
  				echo $input_file["name"].$timeStamp . " <span id='invalid'><b>already exists.</b></span> ";
    		} else {
          /// 임시파일 --> 저장소 파일 이동
        	$sourcePath = $_FILES["input_file"]['tmp_name']; // Storing source path of the file in a variable
          $targetPath = getcwd()."/temp_image/".$timeStamp.$_FILES["input_file"]['name']; // Target path where file is to be stored
          move_uploaded_file($sourcePath, $targetPath) ; // Moving Uploaded file

          /// 이미지를 아마존 S3로 업로드
          $s3Client = new S3Client([
          	'version'     => 'latest',
          	'region'      => 'ap-northeast-2',
          	'credentials' => [
	          	'key'    => 'AKIAJZ7Q6YBOY25WL7JA',
	          	'secret' => '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',
          	],
          ]);
          $bucket = 'firstphp'; // --> 아마존 웹서비스에서 내 버킷
          $keyname = $timeStamp.$_FILES["input_file"]['name'];
          // $filepath should be absolute path to a file on disk
          $filepath = $targetPath;
          try {
          	$result = $s3Client->putObject([
          		'Bucket' => $bucket,
          		'Key'    => $keyname,
          		'Body'   => fopen($filepath, 'r'),
          		'ACL'    => 'public-read',
          		]);
          	$returnURL = $result->get("@metadata")["effectiveUri"];
          	unlink($targetPath);
          	echo $returnURL;
          } catch (Aws\Exception\S3Exception $e) {
          	echo "There was an error uploading the file.\n";

          	print_r($e);
          }
        }
      }
    } else {
    	echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
  }
?>

