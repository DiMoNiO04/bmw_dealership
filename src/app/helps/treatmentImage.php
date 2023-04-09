<?php 
//Работа с изображением
function treatmentImg() {
	if(!empty($_FILES['img']['name'])) {
		$imgName = time() . '_' . $_FILES['img']['name'];
		$fileTmpName = $_FILES['img']['tmp_name'];
		$fileType = $_FILES['img']['type'];
		$destination = ROOT_PATH . "\assets\images\dest\models\\" . $imgName;

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