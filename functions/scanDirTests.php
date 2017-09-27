<?php
function scanDirTests($dir = false)
{
  if (file_exists($dir))
  {
	$form = "<h1>Список тестов</h1><form method=\"GET\" action=\"test.php\"><select name=\"selectedTest\"><option disabled>Выбирете тест!</option>";
	$scanDir = scandir($dir);
	if ($scanDir)
	{
	  foreach (scandir($dir) as $value)
	  {
		if (stripos($value, '.json'))
	    {
		  $form .= "<option value=\"{$dir}/{$value}\">$value</option>";
		}
	  }
	  $form .= "<input type=\"submit\" value=\"Выбрать!\"></select></form>";
	  return (string) $form;
	}
	else
	{
	  return (string) "<h1>In directory files not found!</h1>";
	}
  }
  else
  {
	return (string) "<h1>Directory not found!</h1>";
  }
}