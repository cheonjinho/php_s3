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
					<p><?php echo $item['price'] ?></p>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</body>
</html>


<div style="border: solid 1px gray; margin: 2px; padding: 2px;">
	<span><?php echo $item['title'] ?></span>
	<span><?php echo $item['type_a'] ?></span>
	<span><?php echo $item['type_b'] ?></span>
	<span><?php echo $item['price'] ?></span>
	<img style="width: 30px; height: 30px;" src=<?php echo aws_upload_url() . $item['url'] ?>>
</div>