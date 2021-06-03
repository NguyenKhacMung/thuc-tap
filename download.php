
<?php	
if(isset($_POST['submit']))
{	

	$url = 	$_POST['url'];
// Use basename() function to return the base name of file 
	$file_name = basename($url);

	$parts = parse_url($url);

	$str = $parts['scheme'].'://'.$parts['host'].$parts['path'];


	if(file_put_contents( $file_name,file_get_contents($url))) {
		echo "File downloaded successfully";
	}
	else {
		echo "File downloading failed.";
	}
	echo $str;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Download</title>


</head>

<body>
	
	<form method="post" action="download.php" >
		<input type="text" name="url" class="form-control">

		<button class="btn btn-primary btn-block" name="submit">Download</button>
		
	</form>
</body>
</html>