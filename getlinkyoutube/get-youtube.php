<?php
function curl($url) {
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}
function getIdYoutube($link){
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $id);
    if(!empty($id)) {
        return $id = $id[0];
    }
    return $link;
}
function getVideoYoutube($link) {
    $id = getIdYoutube($link);
    $getlink = "https://www.youtube.com/watch?v=".$id;
    if ($get = curl($getlink )) {
        $return = array();
        if (preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $get, $data)) {
            $jsonData  = json_decode($data[1], true);
            $streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
            foreach (explode(',', $streamMap) as $url)
            {
                $url = str_replace('\u0026', '&', $url);
                $url = urldecode($url);
                parse_str($url, $data);
                $dataURL = $data['url'];
                unset($data['url']);
                $return[$data['quality']."-".$data['itag']] = $dataURL.'&'.urldecode(http_build_query($data));
            }
        }
        return $return;
    }else{
        return 0;
    }
}
echo '<pre>';
print_r(getVideoYoutube('https://www.youtube.com/watch?v=KjuGYC88CA6'));
echo '</pre>';
?>