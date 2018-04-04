<?php
  $target_dir = "/var/www/html/reference/";
  $referenceImage = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $referenceImage);

  $outputName = $_POST['outputName'];

  if (preg_match('/(\.jpg|\.png|\.bmp)$/', $outputName))
  {
    $outputName = "/var/www/html/mosaics/".$outputName;
  }
  else
  {
    $outputName = "/var/www/html/zoomableMosaics/".$outputName;
  }

  $numHorizontal = $_POST['numHorizontal'];
  $mosaicTileWidth = $_POST['mosaicTileWidth'];
  $mosaicTileHeight = $_POST['mosaicTileHeight'];
  $imageTileWidth = $_POST['imageTileWidth'];
  $repeat = $_POST['repeat'];
  $cropType = $_POST['cropType'];
  $spin = $_POST['spin'];
  $flip = $_POST['flip'];
  $trueColor = $_POST['trueColor'];
  $file = $_POST['file'];

  $str = "/var/www/html/RunMosaic";
  $str .= " -p ".$referenceImage;
  $str .= " -d /var/www/html/input/files/";
  $str .= " -o ".$outputName;
  $str .= " -n ".$numHorizontal;
  $str .= " -c ".$cropType;

  if($spin!='0') $str .= " -s";
  if($flip!='0') $str .= " -f";
  if($trueColor!='0') $str .= " -t";

  if($mosaicTileWidth!='') $str .= " -m ".$mosaicTileWidth;
  if($mosaicTileHeight!='') $str .= " -l ".$mosaicTileHeight;
  if($imageTileWidth!='') $str .= " -i ".$imageTileWidth;
  if($repeat!='') $str .= " -r ".$repeat;
  if($file!='') $str .= " --file ".$file;

  $str .= " 2> /dev/null";

  echo $str;

  exec($str);
?>