<?php 
require __DIR__ . '/functions/scanDirTests.php';
$testsDir = __DIR__ . '/data/tests';

$scanDirTests = scanDirTests($testsDir);
$scanDirTestsResponse = '';

if (is_string($scanDirTests))
{
  $scanDirTestsResponse = $scanDirTests;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Список тестов</title>
  <link rel="stylesheet" type="text/css" href="css/list.css">
</head>
<body>
  <div class="main">
  	<div class="tests-list">
  	  <?php
  	  if ($scanDirTestsResponse != '')
      {
        echo $scanDirTestsResponse;
      }
  	  ?>
      <div class="tests-list-ref">
        <p>
          <a href="admin.php">Загрузить тест</a>
        </p>
      </div>
  	</div>
  </div>
</body>
</html>