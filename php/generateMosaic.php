<?php
  $target_dir = "/var/www/html/reference/";
  $referenceImage = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $referenceImage);

  $outputName = $_POST['outputName'];
  $outputNameTMP = $outputName;
  $outputUrl = "LOCATION: ";

  if (preg_match('/(\.jpg|\.png|\.bmp)$/', $outputName))
  {
    $outputUrl .= "/mosaics/".$outputName;
    $outputName = "/var/www/html/mosaics/".$outputName;
  }
  else
  {
    $outputUrl .= "/zoomableMosaics/".$outputName.".html";
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

  $str = "export LD_LIBRARY_PATH=/usr/local/lib/ && /var/www/html/RunMosaic -q";
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

  exec($str);

  if(!preg_match('/(\.jpg|\.png|\.bmp)$/', $outputName))
  {
    exec("sudo sed -i 's/var outputName =.*/var outputName = \"".$outputNameTMP."\/\"/' /var/www/html/"."/zoomableMosaics/".$outputNameTMP.".html");
    exec("sudo sed -i 's/var outputDirectory =.*/var outputDirectory = \"".$outputNameTMP."\/zoom\/\"/' /var/www/html/"."/zoomableMosaics/".$outputNameTMP.".html");
  }

  header($outputUrl);
?>