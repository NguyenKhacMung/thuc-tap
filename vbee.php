<!-- <?php   
$link = '';
if(isset($_POST['submit']))
{  
	$text =    $_POST['text'];
	$voice = $_POST['voice']; 
	$url=file_get_contents("https://vbee.vn/api/v1/convert-tts?input_text=$text&voice=$voice&bit_rate=128000");
	$data = json_decode($url, true);

	$link = $data['download'];
	// header("location: $link"); 
}
?> -->
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
			height: 50px;			
			width: 120px;
			color: white;		
			font-size: 18px;	
		}
		a{
			font-size: 20px;
		}
		.title-mb {
			text-transform: unset;
			text-align: center;
			color: #242424;
			padding-top: 10px;
			font-size: 38px;
		}
		textarea {
			height: 150px;
			max-width: 100%;
			width: 100%;
			max-height: 150px;
			color: #000;
			padding: 8px;
			line-height: inherit;
			font-size: 16px;
		}
		#main{
			background-image: url(https://vbee.vn/images/bg-ttp-vb.svg?a4974ac6df54905104644dbb4304a39f);
			background-repeat: no-repeat;
			background-size: cover;
			padding-bottom: 100px;
		}
		select.selectpicker{
			height: 50px;
			font-size: 18px;	
			width: 100%;
		}	
		select {cursor: pointer;}
		.col-sm-4{
			padding: 0px 0px;
		}
		.col-sm-3{
			padding: 0px 0px;
		}
		@media only screen and (max-width: 540px) {
			.title-mb {

				font-size: 24px;

			}
		}
	</style>

</head>

<body>
	
	<div class="container">
		<br/>
		<h1 class="title-mb">Chuyển văn bản thành giọng nói nhân tạo có cảm xúc</h1>
		<div class="row"  id="main">
			<div class="col-sm-12"  >
				<form class="download" method="post" action="" >										
					<div class="form-group" style="margin-bottom: 0px;">
						<textarea id="text" maxlength="500" placeholder="Xin chào, tôi là giọng nói nhân tạo của Vbee. Với Vbee cách thức làm nội dung được cách mạng hoá, không còn thủ công như truyền thống. Công nghệ AI-Text To Speech của Vbee giúp tăng mạnh tốc độ sản xuất nội dung; giảm thiểu nhân sự, chi phí vận hành." required ></textarea>
					</div>
					<div class="col-sm-3">
						<select class="selectpicker form-control" data-style="btn-primary" id="nnn">
							<option class="option2" value="vi"selected>Tiếng Việt</option>
							<option class="option2" value="en">Tiếng Anh</option>
							<option class="option2" value="fr" >Tiếng Pháp </option>				
							<option class="option2" value="ja" >Tiếng Nhật </option>
							<option class="option2" value="kr" >Tiếng Hàn </option>
							<option class="option2" value="cmn" >Tiếng Trung </option>
						</select>
					</div>
					<div class="col-sm-3">
						<select name="voice" class="selectpicker form-control" id="giong" data-size="5">							
							
						</select>
					</div>
					<div class="col-sm-3">
						<select id="rate" class="selectpicker form-control" >
							<option class="option" value="128000" >Chất lượng: 128 kbps</option>
							<option class="option" value="64000" >Chất lượng: 64 kbps</option>
							<option class="option" value="8000" >Chất lượng: 8 kbps</option>
						</select>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-info" id="submit" style="width: 100%;">Đọc ngay &#9658;</button>
					</div>
					<div class="col-sm-3">
						<audio id="audio" src="" style="width: 100%;">				

						</audio>
					</div>
					<!-- <?php echo $link; ?> -->
				</form>			
			</div>
			<div class="col-sm-12" >
				<div class="col-sm-4" style="margin-top: 15px;">
					<select name="audio" class="selectpicker form-control audio" >
						<option class="option" value="audioMD"  selected>HN Mạnh Dũng Đọc Báo</option>
						<option class="option" value="audioTT">SG Thảo Trinh Đọc Báo</option>
						<option class="option" value="audio" >Hn Ngọc Huyền Đọc Báo</option>
						<option class="option" value="audioMP">Hn Mai Phương Đọc Báo</option>
					</select>
				</div>
				<div class="col-sm-4" style="margin-top: 15px;">
					<select name="voice" class="selectpicker form-control" >
						<option class="option" value="" style="margin-left: 40px;"  selected>Chất lượng: 180 kbps</option>
					</select>
				</div>
				<div class="col-sm-4" style="margin-top: 15px;">

					<audio playsinline controls id="audiodb" src="https://vbee.vn/images/audioMD.mp3" type="audio/mp3" style="width: 100%;">
						Trình duyệt không hỗ trợ phát âm thanh

					</audio>
				</div>
			</div>
		</div>

	</div>
	<script>
		$(document).ready(function(){

			var count = 0;
				//chọn ngôn ngữ
				var nn=  $("#nnn").val();								
				ngonNgu();
				$("#nnn").change(function(){
					nn= $(this).val();
					$("#audio").attr("src", "");
					pause();	
					ngonNgu();
				});	

				function ngonNgu() {

					$.getJSON("https://vbee.vn/api/v1/get-list-voice-tts",function(data) {
						var html = '';
						$.each(data.voices[nn], function( key, val ) {	
							html +="<option class='option2' value="+key+">"+val+"</option>";
						});
						$('#giong').html(html);
					});

				};

				$(".audio").change(function(){
					var audio1= $(this).val();
					$("#audiodb").attr("src", "https://vbee.vn/images/"+audio1+".mp3");
				});

				//Chọn giọng đọc
				var voice=  $("#giong").val();
				$("#giong").change(function(){
					voice= $(this).val();	
					$("#audio").attr("src", "");
					pause();
				});
				//Chọn chất lượng
				var rate=  $("#rate").val();
				$("#rate").change(function(){
					rate= $(this).val();	
					$("#audio").attr("src", "");
					pause();
				});
				//dọc ngay
				$('form').submit(function(e){
					e.preventDefault();
					var text= $('#text').val();
					$("#text").click(function(){
						$("#audio").attr("src", "");
						pause();
					});
					if($("#audio").attr("src")==""){	

						$.getJSON("https://vbee.vn/api/v1/convert-tts?input_text="+text+"&voice="+voice+"&bit_rate="+rate, function( data ) {
							$("#audio").attr("src", data.download);
							play();
						});

					}else{
						if(count == 0){
							play();						
						}else{
							pause();					
						}
					}

					$("#audio")[0].onended = function() {
						pause();
					};
					
				});	
				function play(){
					$("#audio")[0].play();
					$('#submit').html("Pause &#9208;");
					count = 1;
				};
				function pause(){
					$("#audio")[0].pause();
					$('#submit').html("Play &#9658;");
					count = 0;
				};	
			});
		</script>

	</body>
	</html>
