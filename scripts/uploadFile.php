<?php

  function uploadFile($files, $image_path) {
    if(isset($files['photo']) && $files['photo']['error'] === UPLOAD_ERR_OK) {
        
      $target_dir = "../uploads/";
      $target_file = $target_dir . basename($files["photo"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if ($files["photo"]["size"] > 500000)
        return $image_path;

      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" )
        return $image_path;

      if(move_uploaded_file($files["photo"]["tmp_name"], $target_file));
        return $target_file;

      return $image_path;
    }  
    return $image_path;
  }
?>