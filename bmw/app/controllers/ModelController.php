<?php

require(SITE_ROOT . '/app/services/ModelService.php');
$modelService = new ModelService();

class ModelController {
  public function addModel(): void {
    global $modelService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-create']))) {
      $modelService -> addModel();
    } 
  }

  public function updateModel(): void {
    global $modelService;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['model-edit']))) {
      $modelService -> updateModel();
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
    global $modelService;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id']; 
      $modelService->deleteModel($id);
    }
  }
}
?>