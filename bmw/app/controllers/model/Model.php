<?php

include('../../app/helps/treatmentImage.php');

require('ModelController.php');
$modelController = new ModelController();

class Model {
  public function addModel(): void {
    global $modelController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-create']))) {
      $modelController -> addModel();
    } 
  }

  public function updateModel(): void {
    global $modelController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-edit']))) {
      $modelController -> updateModel();
    }
  }

  public function editModel(): array {
      if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();
      
      $id = $_GET['id'];
      $model = $db->selectOne('models', ['id' => $id]);

      $id = $model['id'];
      $modelName = $model['model'];
      $img = $model['main_foto'];

      $arrRes = [$id, $modelName, $img];
      return $arrRes;
    }
  }

  public function deleteModel(): void {
    global $modelController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id']; 
      $modelController->deleteModel($id);
    }
  }
}
?>