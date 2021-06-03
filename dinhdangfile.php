<?php

// hàm lấy định dạng file qua URL (mime type)

function getUrlMimeType($url) {

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$html = curl_exec($ch);

curl_close($ch);

preg_match('/xthotlink\=(.*?)\"/', $html, $match);

if(isset($match[1])){

$buffer = file_get_contents($url.'?xthotlink='.$match[1]);

} else {

$buffer = file_get_contents($url);

}

$finfo = new finfo(FILEINFO_MIME_TYPE);

return $finfo->buffer($buffer);

}

echo getUrlMimeType('http://lib.qnu.edu.vn/wpViewFile.aspx?EdataFileDetailId=1695');

?>