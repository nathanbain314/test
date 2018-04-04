<?php
$files = glob('mosaics/*');
foreach($files as $file)
{
  if(is_file($file))
    unlink($file);
}
 ?>