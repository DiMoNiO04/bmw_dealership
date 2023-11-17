<?php

include('../../app/helps/treatmentImage.php');

require('ModelsActions.php');
$modelsActions = new ModelsActions();

class Model {
  public function addModel(): void {
    global $modelsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-create']))) {
      $modelsActions -> addModel();
    } 
  }

  public function updateModel(): void {
    global $modelsActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-edit']))) {
      $modelsActions -> updateModel();
    }
  }

  public function editModel(): array {
      if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();
      
      $id = $_GET['id']; //Получаем айди модели , которую хотим изменить 
      $model = $db->selectOne('models', ['id' => $id]); //Получаем все данные можели, которую хотим изменить

      //Получаем данные модели которую хотим изменить в переменные
      $id = $model['id'];
      $modelName = $model['model'];
      $img = $model['main_foto'];

      $arrRes = [$id, $modelName, $img];
      return $arrRes;
    }
  }

  public function deleteModel(): void {
    global $modelsActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди модели, которую хотим удалить
      $modelsActions->deleteModel($id);
    }
  }
}
?>