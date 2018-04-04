<?php
$files = array_filter(glob("/var/www/html/zoomableMosaics/*"), function($v) {
    return false === strpos($v, 'js') || false === strpos($v, 'icons');
});
foreach($files as $file)
{
  if(is_file($file))
    unlink($file);
}
 ?>