<?php 
function сheckCorrectnessTest($array) // проверка массива на корректную вложенность.
{
  if (is_array($array))
  {
   	foreach ($array as $value)
   	{
	  if (is_array($value))
	  {
	   	foreach ($value as $question)
	   	{
	      if (!is_array($question))
	   	  {
	   	    return true;
	   	  }
	      else
	   	  {
 	        return false;
	   	  }
	   	}
	  }
	  else
	  {
	    return false;
	  }
    }
  }
  else
  {
  	return false;
  }
}