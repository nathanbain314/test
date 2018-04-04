<?php
$files = glob('/var/www/html/input/files/*');
foreach($files as $file)
{
  if(is_file($file))
    unlink($file);
}
 ?>