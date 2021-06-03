<?php   


$url=file_get_contents("https://gadgets.dantri.com.vn/api/pricing/cars?page=1&sort=brand&query%5Btype%5D=Convertible");
$data = json_decode($url, true);
var_dump($data);
echo"<br>";
// echo"<br>";
// print_r($data);

echo"<br>";
print_r($data['rows']);
echo"<br>";
echo"<br>";
foreach ($data as $key => $val) {
	if(is_array($val)) {
		echo "$key: <br>";
	} else {
		echo "$key => $val <br>";
	}
}
// foreach($data as $key=>$value){
//     echo $value ;
// }
echo"<br>";
$url2=file_get_contents("https://vbee.vn/api/v1/get-list-voice-tts");
$obj = json_decode($url2, true);
// print_r($obj);
echo"<br>";

echo"<br>";
foreach($obj as $key => $value){
	if (is_array($value)) {
		echo "$key: {<br>";

		foreach($value as $ke => $valu){
			
			if (is_array($valu)) {
				echo "$ke: <br>";
				foreach($valu as $k => $val){

					echo  "$k -> $val <br>";
				}	
			}
			else{
				echo  "$ke -> $valu <br>"; 
			}	
		}
		echo "}<br>";
		

	}
	else{
 	 echo  "$key -> $value <br>"; //change accordingly
 	}
 }
 echo"<br>";

 echo"<br>";
 foreach($obj['voices'] as $key => $value){
 	if (is_array($value)) {
 		echo "$key: {<br>";

 		foreach($value as $ke => $valu){		

 			echo  "$ke -> $valu <br>"; 				
 		}
 		echo "}<br>";	
 	}
 	else{
 	 echo  "$key -> $value <br>"; //change accordingly
 	}
 }



 ?>