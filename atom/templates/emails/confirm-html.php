<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Confirm email address</title>
	<style>
		.wow-btn {
			color: #2244ff;
			font-size: 20px;
			text-decoration: none;
			border: 1px solid #2244ff;
			padding: 10px 25px;
			border-radius: 10px;
		}
	</style>
</head>

<body>
	<h1>Welcome!</h1>
	<p>Confirm your email address.</p>
	<center>
		<a href="<?php echo site_url('/') . 'confirm/email/' . $code; ?>" class="wow-btn">Subscribe Now</a>
	</center>
	</br>
	<center>
		<a href="<?php echo site_url('/') . 'unsubscribe/email/' . $email; ?>" class="wow-btn">Unsubscribe Now</a>
	</center>
</body>

</html>