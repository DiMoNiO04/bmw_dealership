<?php

class ModelsActions {

  //Добавление модели
  public function addModel(): void {
    $db = new DataB();

    //Работа с изображением
    treatmentImg("\assets\images\dest\models\\");

    //Забираем данные из формы в переменные
    $modelName = trim($_POST['modelName']);
    
    //Проверка на уникальность названия модели
    $existence = $db->selectOne('models', ['model' => $modelName]);

    //Если данная модель существует
    if($existence['model'] === $modelName) {
      array_push($errMsg, 'Данная модель авто уже существует!');
    } else {
      
      //Формируем массив для отправки
      $model = [
        'model' => $modelName,
        'main_foto' => $_POST['img'],
      ];

      $id = $db->insert('models', $model); //Отправляем данные в таблицу models
      $model = $db->selectOne('models', ['id' => $id]); //Получаем данные добавленной модели
      header('location:index.php'); //Возвращаем на страницу моделей
    }
  }

  //Редактирование модели
  public function updateModel(): void {
    
    $db = new DataB();

    //Работа с изображением 
    treatmentImg("\assets\images\dest\models\\");

    //Проверям на статус
    if(isset($_POST['status'])) {
      $status = 1;
    } else {
      $status = 0;
    }

    //Формируем массив для отправки данных
    if(empty($img)) {
      $model = [
        'model' =>  trim($_POST['modelName']),
      ];	
    } else {
      $model = [
        'model' => trim($_POST['modelName']),
        'main_foto' => $_POST['img'],
      ];	
    }

    $id = $_POST['id']; //Получаем id модели, которую хотим редактировать

    //Отправляем данные в таблицу модели
    $modelId = $db->update('models', $id, $model); //Обновляем данные
    header('location:index.php'); //Возвращаем на страницу моделей
  }

  //Удаление модели
  public function deleteModel($id): void {
    $db = new DataB();
    $db->delete('models', $id); //Удаляем
    header('location:index.php'); //Возвращаем на страницу моделей
  }
}

?>