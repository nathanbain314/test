<?php
  $target_dir = "/var/www/html/reference/";
  $referenceImage = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $referenceImage)

  $outputName = $_POST['outputName'];
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

  $str = "/home/nathanbain314/mosaic/RunMosaic";
  $str1 .= " -p ".$referenceImage;
  $str1 .= " -d input/files/";
  $str1 .= " -o ".$outputName;
  $str1 .= " -n ".$numHorizontal;
  $str1 .= " -c ".$cropType;
  $str1 .= " -s ".$spin;
  $str1 .= " -f ".$flip;
  $str1 .= " -t ".$trueColor;

  if($mosaicTileWidth!='') $str1 .= " -m ".$mosaicTileWidth;
  if($mosaicTileHeight!='') $str1 .= " -l ".$mosaicTileHeight;
  if($imageTileWidth!='') $str1 .= " -i ".$imageTileWidth;
  if($repeat!='') $str1 .= " -r ".$repeat;
  if($file!='') $str1 .= " --file ".$file;

  echo $str
?>