
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="https://vbee.vn/images/favicon.png"/>
	<title>Vbee</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

	<span>


	</span>
	<span id="a">


	</span>
	<script>
		$(document).ready(function(){

			
			
			$.getJSON("https://vbee.vn/api/v1/get-list-voice-tts", function( data ) {
				var html = '';
				$.each(data.voices, function( key, val ) {	

					if($.isArray(val)){
						alert("aa");
						$.each(val, function( ke, va ) {	
							html +=ke+"->"+va+"<br>";

						});
					}else{
						html +=key+"->"+val+"<br>";
						
					}
					
				});
				$('span').html(html);
				console.log(html);
			});


			$.getJSON("https://vbee.vn/api/v1/convert-tts?input_text=xin+ch%C3%A0o&voice=hue_female_huonggiang_news_48k-thg&bit_rate=128000", function( data ){
				var html = '';
				$.each(data, function( key, val ) {		
					html +=key+"->"+val+"<br>";
				});
				console.log(html);
			});

		});
	</script>

</body>
</html>
