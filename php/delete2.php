<?php
$files = glob('/var/www/html/mosaics/*');
foreach($files as $file)
{
  if(is_file($file))
    unlink($file);
}
 ?>