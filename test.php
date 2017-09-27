<?php 
require __DIR__ . '/functions/сheckCorrectnessTest.php';
require __DIR__ . '/functions/testGen.php';

$testGen = testGen();
$testGenResponse = '';

if (is_string($testGen))
{
  $testGenResponse = $testGen;
}

if (is_array($testGen))
{
  foreach ($testGen as $statusCode => $message)
  {
    if ($statusCode == 404)
    {
      header( 'Refresh: 3; list.php', true, $statusCode );
    }

    if ($statusCode == 418)
    {
      header( 'Refresh: 3; list.php', true, $statusCode );
    }
    
    $testGenResponse = $message;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Тест</title>
  <link rel="stylesheet" type="text/css" href="css/test.css">
</head>
<body>
  <div class="main">
  	<div class="test">
  	  <?php
      if ($testGenResponse != '')
      {
        echo $testGenResponse;
      }
  	  ?>
  	  <div class="test-ref">
  	  	<p>
          <a href="admin.php">загрузить новый тест</a>
        </p>
  	  	<p>
          <a href="list.php">список тестов</a>
        </p>
  	  </div>
  	</div>
  </div>
</body>
</html>