<?php

if (!empty($_GET['url'])) {
	$url = $_GET['url'];
	if (get_data($url, $element)) {
		preg_match('#xmlURL = "(.+?)";#', $element, $return);
		$link = $return[1];
		if (get_data($link, $xml)) {
			preg_match('#<!\[CDATA\[(.+?)\?st=#', $xml, $mp3);
			$result = $mp3[1];

		} else {
			$error = 'lỗi không đọc được định dạng xml !';
		}

	} else {
		$error1 = 'Lỗi chưa xác định (link nhạc có thể bị sai) vui lòng kiểm tra lại !';
	}

}

function get_data($url, &$data = '') {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 7);

	$data = curl_exec($ch);
	$error = curl_error($ch);
	curl_close($ch);
	if (empty($error)) {
		return true;
	} else {
		return false;
	}

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Author: Dominix Lucifer</title>
	<meta charset="utf-8">
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
body {
    background-image:url('https://mangxahoi.club/wall/4.png');
    background-repeat:no-repeat;
   background-size: cover;


}
h1{
	color:white;
}

</style>

</head>
<body>
	<div class="container">
		<center>
			<h1>Bản quyền thuộc về Dominix Lucifer</h1>
		</center>

	</div>
	<div class="container">

		<center>
			<div class="row">
				<div class="panel panel-primary">
				    	<form action="" method="get" role="form" >
		<div class="panel panel-body">
		<legend>Công cụ get link nhạc từ <img width="30" src="https://stc-id.nixcdn.com/v11/images/favicon.ico">Nhaccuatui</legend>
		<?php if (empty($result) || isset($error) || isset($error1)) {
	?>
		<div class="form-group">
			<h4 style="color:red"><?php
if (isset($error)) {
		echo $error;
	}
	echo '|';
	if (isset($error1)) {
		echo $error1;
	}
	?><h4>
			<div class="form-group">
			<label for="link">Link nhạc cần get</label>
			<input id="link" class="form-control" type="text" name="url">
			</div>
			<input class="btn btn-primary" type="submit" value="Get link" name="submit">
		</div>
	<?php } else {?>
		<div class="form-group">
			<div class="col-xs-6">
				<h4><?php echo $result; ?></h4>
			</div>
			<div class="col-xs-6">
				<a class="btn btn-success" href=<?php echo '"' . $result . '"'; ?>>Tải nhạc chất lượng cao</a>
			</div>
		</div>
	<?php }?>


</div>
	</form>
	</div>
	</div>
	</center>
	</div>
</body>
</html>