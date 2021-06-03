<?php

//index.php

$image = '';
$error = '';

if(isset($_POST["download"]))
{
   if(empty($_POST["url"]))
   {
      $error = '<p class="text-danger"><b>Enter URL</b></p>';
  }
  else if(!filter_var($_POST["url"], FILTER_VALIDATE_URL))
  { 
      $error = '<p class="text-danger"><b>Invalid URL</b></p>';
  }
  else
  {
      $url = $_POST["url"];
      $start = curl_init();
      curl_setopt($start, CURLOPT_URL, $url);
      curl_setopt($start, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($start, CURLOPT_SSLVERSION, 3);
      $file_data = curl_exec($start);
      curl_close($start);
      $file_path = 'download/' . uniqid() . '.jpg';
      $file = fopen($file_path, 'w+');
      fputs($file, $file_data);
      fclose($file);
      $image = '<img src="'.$file_path.'" class="img-thumbnail" width="250" />';
  }
}

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Download File from URL using PHP CURL</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
      .box
      {
         width:100%;
         max-width:720px;
         margin:0 auto;
     }
 </style>
</head>
<body>
  <div class="container">
     <br />
     <h2 align="center">Download File from URL using PHP CURL</h2><br />
     <div class="row">
        <div class="col-md-3">
           
        </div>
        <div class="col-md-9">
           <form method="post">
              <div class="form-group">
                 <label>Enter URL</label>
                 <input type="text" name="url" class="form-control input-lg" autocomplete="off" />
                 <?php echo $error; ?>
             </div>
             <br />
             <br />
             <input type="submit" name="download" value="Download" class="btn btn-info btn-lg" />
             <br />
             <br />
             <?php echo $image; ?>
         </form>
         <br />
         
     </div>
 </div>
</div>
<div style="clear:both"></div>
<br />

<br />
<br />
<br />
</body>
</html>
