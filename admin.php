<?php
require __DIR__ . '/functions/uploader.php';
$dir = __DIR__ . '/data/tests/';

$uploader = uploader(array('json'), 1000, $dir);
$uploaderResponse = '';
      
if (is_string($uploader))
{
  $uploaderResponse = $uploader;
}

if (is_array($uploader))
{
  foreach ($uploader as $statusCode => $message)
  {
    if ($statusCode == 303)
    {
      header( 'Refresh: 3; list.php', true, $statusCode );
    }
    if ($statusCode == 418)
    {
      header( 'Refresh: 3; admin.php', true, $statusCode );
    }
    $uploaderResponse = $message;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Загрузка json на сервер</title>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
  <div class="main">
  	<div class="upload-files-form">
  	  <?php
      if ($uploaderResponse != '')
      {
        echo $uploaderResponse;
      }
  	  ?>
	    <div class="upload-files-form-ref">
  	  	<p>
  	      <a href="list.php">список тестов</a>
  	    </p>
	    </div>
      <div class="upload-files-form-test-example">
        <h3>Пример json'а</h3>
        <img src="example.png">
      </div>
  	</div>
  </div>
</body>
</html>