<?php 
function treatmentImg($folder) {
  if(!empty($_FILES['img']['name'])) {
    $imgName = time() . '_' . $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileType = $_FILES['img']['type'];
    $destination = PATCH . $folder . $imgName;
    echo $destination;
    if(strpos($fileType, 'image') === false) {
      die("Можно загружать только изображения");
    } else {
      
      $result = move_uploaded_file($fileTmpName, $destination);

      if($result) {
        $_POST['img'] = $imgName;
      } else {
        $errMsg = "Ошибка: загрузка изображения на сервер";
      }
    } 
  } else {
    $errMsg = "Ошибка: получения изображения на сервер";
  }	
}
?>