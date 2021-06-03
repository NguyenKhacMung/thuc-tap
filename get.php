
<?php   
$link = '';
if(isset($_POST['submit']))
{   

	$url =    $_POST['url'];
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	$id=$query['Id']+5;
	$link ='<a  href="http://lib.qnu.edu.vn/wpViewFile.aspx?EdataFileDetailId='.$id.'">http://lib.qnu.edu.vn/wpViewFile.aspx?EdataFileDetailId='.$id.'</a>';
	

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
		.btn{
			color: black;
		}
		a{
			font-size: 20px;
		}
	</style>

</head>

<body>
	
	<div class="container">
		<br />
		<h2 align="center">Download File from URL</h2><br />
		<div class="row">
			<div class="col-md-12">
				<form class="download" method="post" action="" >
					<div class="form-group">
						<label>Enter URL</label>
						<input type="text" name="url" >         
					</div>
					<br />
					<br />
					<button class="btn btn-primary" name="submit">Download</button>
					<br />
					<br />
					<?php echo $link; ?>
				</form>
				<br />

			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>