<?php 
require __DIR__ . '/сheckCorrectnessTest.php';
function uploader($fileTypesArray, $maxFileSize, $uploadDir)
{
  if(!isset($_POST["submitted"]))
  {
    
    $form = "<form method='POST' enctype='multipart/form-data'>
      <p>Загрузить файл:</p>
      <input type='hidden' name='submitted' value='TRUE' id='1'>
      <input type='hidden' name='MAX_FILE_SIZE' value='" . $maxFileSize . "'>
      <input type='file' name='file[]'>";
    
    $form .= "<p><input type='submit' value='Upload'> Valid file type(s): ";
    
    for($x=0; $x < count($fileTypesArray); $x++)
    {
      
      if($x < count($fileTypesArray)-1)
      {
        $form .= $fileTypesArray[$x] . ", ";
      }
      
      else
      {
        $form .= $fileTypesArray[$x] . ".";
      }
    }
    $form .= "</p></form>";
    return (string) $form;
  }
  else
  {
      
    $originalFileName = $_FILES["file"]["name"][0];
    if($_FILES["file"]["name"][0] != "")
    {
      if($_FILES["file"]["error"][0] == UPLOAD_ERR_OK)
      {
        $fileName = explode(".", $_FILES["file"]["name"][0]);
        $fileNameExt = $fileName[count($fileName)-1];
        unset($fileName[count($fileName)-1]);
        $fileName = implode(".", $fileName);
        $fileName = substr($fileName, 0, 15) . "." . $fileNameExt;
          
        if(in_array($fileNameExt, $fileTypesArray))
        {
          if($_FILES["file"]["size"][0] < $maxFileSize)
          {
            $buffer = @file_get_contents($_FILES["file"]["tmp_name"][0]);
            if ($buffer)
            {
              $buffer = json_decode($buffer, true);
              if (сheckCorrectnessTest($buffer))
              {
                if(move_uploaded_file($_FILES["file"]["tmp_name"][0], $uploadDir . $fileName))
                {
                  return array( 303 => "<p>Файл успешно загружен ( {$fileName} ).</p>");
                }
                else
                {
                  return array( 418 => "<p>{$originalFileName} Загрузка не завершена.</p>");
                }
              }
              else
              {
                unlink($_FILES["file"]["tmp_name"][0]);
                return array( 418 => '<p>Тест создан неправильно, файл не был загружен.</p>' );
              }
            }
            else
            {
              return array( 418 => "<p>Ой, что-то пошло не так.</p>");
            }
          }
          else
          {
            return array( 418 => "<p>{$originalFileName} Файл слишком большой.</p>");
          }
        }
        else
        {
          return array( 418 => "<p>{$originalFileName} Файл не был загружен.</p>");
        }
      }
      else
      {
        return array( 418 => "<p>{$originalFileName} Недопустимое расширение файла.</p>");
      }
    }
    else
    {
      return array( 418 => '<p>Файл не выбран!</p>');
    }
  }
}