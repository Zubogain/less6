<?php
require __DIR__ . '/certGen.php';
function testGen()
{
  $buffer = @file_get_contents($_GET['selectedTest']);
  if ($buffer)
  {
	
    $buffer = json_decode($buffer, true);

    if (сheckCorrectnessTest($buffer))
    {
	  $form = "<form><p><input type=\"text\" name=\"userName\" placeholder=\"Ваше имя\"></p>";
	  $i = 0;
	  foreach ($buffer as $key => $array)
	  {
        $form .= "<h3>{$key}</h3>";
	    $i++;
	    foreach ($array as $arrayKey => $arrayValue)
	    {
	      $explode = explode('_', $arrayKey);
	  	  $form .= "<p class=\"test-question\"><input type=\"radio\" name=\"q{$i}\" value=\"{$explode[0]}\"> {$arrayValue}</p>";
	    }
	  }
	    $form .= "<p><input type=\"hidden\" name=\"selectedTestTest\" value=\"$_GET[selectedTest]\"><input type=\"submit\" name=\"endTest\"></p></form>";
	    return (string) $form;
    }
    else
    {
      unlink($_GET['selectedTest']);
	  return array( 418 => '<h2>Тест создан неправильно, тест удален!</h2>');
    }
  }
  else
  {
    if (!empty($_GET['endTest']))
    {

	  $buffer = @file_get_contents($_GET['selectedTestTest']);
		
	  if ($buffer)
	  {
	    $buffer = json_decode($buffer, true);
	    if (сheckCorrectnessTest($buffer))
	    {
	      $userName = 'Гость';
	      $correctAnswers = 0;
		  $wrongAnswers = 0;
		  $counter = 0;
		  $questionName = NULL;
		  $inGeneralQuestions = 0;
		  if (!empty($_GET['userName']))
		  {
		  	$userName = (string) strip_tags($_GET['userName']);
		  }

		  foreach ($buffer as $key => $array)
		  {
		    $counter++;
		    $inGeneralQuestions = $counter;
		    $questionName = 'q' . $counter;
		    foreach ($array as $arrayKey => $arrayValue)
		    {
		      $explode = explode('_', $arrayKey);
		      if (count($explode) == 2)
		      {
		        if (@$_GET[$questionName] == $explode[0])
		        {
		          $correctAnswers++;
		        }
		        else
		        {
			      $wrongAnswers++;
		        }
			  }
		    }
		  }
		  if ($correctAnswers == 0)
		  {
		    return (string) "<h2>Эхх {$userName}, вы ответили на все вопросы неправильно.</h2>";
		  }
		  elseif ($wrongAnswers == 0)
		  {
		    return (string) "<h2>Поздровляем {$userName}, вы ответили на все вопросы правильно!</h2>" . saveImageCert('././images/originalCert.png', '././fonts/arial.ttf', $userName, '././images/save/', 'userCert.png') . '<div><img src="././images/save/userCert.png"><p><a href="././images/save/userCert.png" download>Скачать!</a></p></div>';
		  }
		  elseif ($wrongAnswers != 0 and $correctAnswers == $inGeneralQuestions)
		  {
		    return (string) "<h2>Поздровляем {$userName}, вы ответили на все вопросы правильно!</h2>" . saveImageCert('././images/originalCert.png', '././fonts/arial.ttf', $userName, '././images/save/', 'userCert.png') . '<div><img src="././images/save/userCert.png"><p><a href="././images/save/userCert.png" download>Скачать!</a></p></div>';

		  }
		  else
		  {
		    return (string) "<h2>{$userName}, правельных {$correctAnswers} из {$inGeneralQuestions}</h2>";
	      }
	    }
	    else
	    {
	      unlink($_GET['selectedTestTest']);
	      return array( 418 => '<h2>Тест создан неправильно, тест удален!</h2>');
	    }
	  }
	  else
	  {
	    return array( 404 => '<h2>error: test not found!</h2>');
	  }
    }  
    else
    {
      return array( 404 => '<h2>error: test not found!</h2>');
    }
  }
}