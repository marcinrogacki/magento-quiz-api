<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/lib/css/style.css"/>
	</head>
	<body>
		<div id="container">
			hello world	
			<?php foreach($posts as $key => $post):?>
				<h2><?php echo $key . ' => ' . $post;?></h2>
			<?php endforeach;?>
		</div>
	</body>
</html>
