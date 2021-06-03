<?php   
$link = '';
if(isset($_POST['submit']))
{  

	$voice = $_POST['voice']; 
	$url2=file_get_contents("https://vbee.vn/api/v1/get-list-voice-tts");
	$obj = json_decode($url2,true);

	foreach($obj['voices'][$voice] as $key => $value){

		// echo'<option class="option" value="'.$key.'">'.$value.'</option>';	

	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>selcectjson</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style>
		select.selectpicker{
			font-size: 20px;
			left: 50%;
		}
		
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	
	<div class="container">
		<br />
		<br />
		<br />
		<br />
		
		<form class="download" method="post" action="" >					

			<div class="col-sm-6" >
				<select name="voice" class="selectpicker" id="nnn">
					<option class="option2" value="vi">Tiếng Việt</option>
					<option class="option2" value="en">Tiếng Anh</option>
					<option class="option2" value="fr" >Tiếng Pháp </option>				
					<option class="option2" value="ja" >Tiếng Nhật </option>
					<option class="option2" value="kr" >Tiếng Hàn </option>
					<option class="option2" value="cmn" >Tiếng Trung </option>			
				</select>
			</div>
			<div class="col-sm-4" >
				<select name="voice" class="selectpicker" id="giong">

				</select>
			</div>
			<div class="col-sm-4" >
				<button class="btn btn-primary" name="submit">Đọc ngay</button>
			</div>

		</form>

	</div>

	<script>
		$(document).ready(function(){
			// $("#nnn").change(function(){
			// 	var	nn= $(this).val();
			// 	$.ajax({
			// 		url : 'https://vbee.vn/api/v1/get-list-voice-tts',
			// 		type : 'get',
			// 		dataType : 'json',
			// 		success : function (result){
			// 			var html = '';
			// 			$.each (result.voices[nn], function (key, item){
			// 				if(key=='sg_male_minhhoang_news_48k-d'){
			// 					html +="<option class='option2' value="+key+" selected>"+item+"</option>";
			// 				}else{

			// 				html +="<option class='option2' value="+key+">"+item+"</option>";}
			// 			});                    						
			// 			$('#giong').html(html);
			// 		}
			// 	});
			// });
			$.getJSON("https://vbee.vn/api/v1/get-list-voice-tts", function( data ) {
				var html = '';
				$.each(data.voices['vi'], function( key, val ) {	
					html +="<option class='option2' value="+key+">"+val+"</option>";
				});
				$('#giong').html(html);
			});

			$("#nnn").change(function(){
				var nn= $(this).val();	
				$.getJSON("https://vbee.vn/api/v1/get-list-voice-tts", function( data ) {
					var html = '';
					$.each(data.voices[nn], function( key, val ) {	
						html +="<option class='option2' value="+key+">"+val+"</option>";
						// alert( key + ": " + val );
					});
					$('#giong').html(html);
				});
			});	

		});

	</script>

</body>
</html>
