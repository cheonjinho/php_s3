<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/assets/stylesheet/application.css" type="text/css"/>
	<title></title>
</head>
<body>
	<h1>This is Product List</h1>

	<?php foreach ($list as $item) { ?>
		<?php if ($item['url']!='') { ?>
			<div class="image-wrapper" style="background-image: url(<?php echo aws_upload_url() . $item['url'] ?>);">
				<div class="image-title">
					<p><?php echo $item['title'] ?></p>
					<p>￦<?php echo $item['price'] ?></p>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</body>
</html>