<?php
if(isset($_POST['submit']))
{   
	$remoteURL =    $_POST['url'];
	function df($urlFile){
		$file_name  =   basename($urlFile);
    //save the file by using base name
		$fn         =   file_put_contents($file_name,file_get_contents($urlFile));
		header("Expires: 0");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type: application/file");
		header('Content-length: '.filesize($file_name));
		header('Content-disposition: attachment; filename="'.basename($file_name).'"');
		readfile($file_name);
	}
	
	df($remoteURL);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Download</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style>
		.download{
			text-align: center;
			margin-top: 40px;
		}
		input{
			height: 35px;
			width: 500px;

		}
		.btn{
			height: 35px;
			margin-bottom: 2px;
			margin-left: 10px;
			width: 120px;
		}

	</style>
</head>

<body>

	<form class="download" method="post" action="a2.php" >
		<input type="text" name="url" >
		<button class="btn btn-primary" name="submit">Download</button>

	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>