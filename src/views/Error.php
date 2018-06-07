<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/error.css" />
	</head>
	<body>
		<h1><?=$_GET['message']?></h1>
		<section class="error-container">
			<span><?=$_GET['status_code']?></span>
		</section>
		<div class="link-container">
			<button id="go-back" class="back-link">Go Back</button>
		</div>
		<script src="../assets/js/error.js"></script>
	</body>
</html>