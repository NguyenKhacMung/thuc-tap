<?php
if(isset($_REQUEST['submit'])){
 //$weburl variable to store url
	$weburl=$_REQUEST['url']; 
	$html = file_get_contents("$weburl");
    //parsing begins here:
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$nodes = $doc->getElementsByTagName('title');
   //get and display data:
	$title = $nodes->item(0)->nodeValue;
	$metas = $doc->getElementsByTagName('meta');
	$description='';
	$keywords='';
	for ($i = 0; $i < $metas->length; $i++)
	{
		$meta = $metas->item($i);
		if($meta->getAttribute('name') == 'description')
			$description = $meta->getAttribute('content');
		if($meta->getAttribute('name') == 'keywords')
			$keywords = $meta->getAttribute('content');
	}
	echo "Title: $title". '<br/><br/>';
	echo "Description: $description". '<br/><br/>';
	echo "Keywords: $keywords".'<br/><br/>';
	$regex='|<a.*?href="(.*?)"|';
	preg_match_all($regex,$html,$parts);
	$links=$parts[1];
	foreach($links as $link){
		echo "Internal and External Links".": ". $link."<br>";
	}
	echo '<br/>';
	echo "ip address of your webstie:",gethostbyname($weburl). '<br/><br/>'; 
	$start=0;
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	$total_time = round(($finish - $start), 4);
	echo'Load time:Page generated in ' . $total_time . ' seconds.';
	echo '<br/><br/>';

	$ch = curl_init($weburl);
   curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
   curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($ch, CURLOPT_TIMEOUT,10);
   $output = curl_exec($ch);
   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   curl_close($ch);

   echo 'HTTP code: ' . $httpcode;
}
?>
<form action="zing.php" method="POST">

	<table cellspacing="0" height="38%" width="57%" style="border:1px solid;">

		<tr><td width="27%">Enter URL:</td><td width="50%"><input class="input" type="text" id="url" name="url"></td></tr>                     

		<tr> <td></td><td><input type="submit" name="submit" value="submit" /></td></tr>

	</table>

</form>