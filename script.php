<?php
  $dir = "images/gallery";
  $files = scandir($dir);
  $files = excess($files);

  function getExtension($filename) {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
  }

  function excess($files) {
    $result = [];
    for ($i = 0; $i < count($files); $i++) {
      $item = getExtension($files[$i]);
      if($item == 'jpg' || $item == 'png') $result[] = $files[$i];
    }
    return $result;
  }
?>
