
<?php   
if(isset($_POST['submit']))
{    $remoteURL =    $_POST['url'];

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

    $type= getUrlMimeType($remoteURL);
   
    header("Content-type: $type"); 
    header("Content-Disposition: attachment; filename=".basename($remoteURL));
    ob_end_clean();
    readfile($remoteURL);
    exit;
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

    <form class="download" method="post" action="Tai.php" >
        <input type="text" name="url" >
        <button class="btn btn-primary" name="submit">Download</button>

    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>