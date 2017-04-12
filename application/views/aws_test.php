<?php
	use Aws\S3\S3Client;

	$s3Client = new S3Client([
	    'version'     => 'latest',
	    'region'      => 'ap-northeast-2',
	    'credentials' => [
	        'key'    => 'AKIAJZ7Q6YBOY25WL7JA',
	        'secret' => '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',
	    ],
	]);




	$bucket = 'firstphp'; // --> 아마존 웹서비스에서 내 버킷
	$keyname = 'gf.jpg'; // --> 아마존 웹서비스에서 저장할 경로
	// $filepath should be absolute path to a file on disk
	$filepath = 'gf.jpg';  // --> 업로드할 이미지 파일 경로.

	try {


	    $result = $s3Client->putObject([
	        'Bucket' => $bucket,
	        'Key'    => $keyname,
	        'Body'   => fopen($filepath, 'r'),
	        'ACL'    => 'public-read',
	    ]);

	    print_r('대박! 업로드 성공염?ㅋㅋ');

	} catch (Aws\Exception\S3Exception $e) {
	    echo "There was an error uploading the file.\n";

	    print_r($e);
	}