<?php
$files = glob('input/files/*');
foreach($files as $file)
{
  if(is_file($file))
    unlink($file);
}
 ?>