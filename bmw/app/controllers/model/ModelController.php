<?php

class ModelController {

  public function addModel(): void {
    $db = new DataB();

    treatmentImg("\assets\images\dest\models\\");

    $modelName = trim($_POST['modelName']);
    
    $existence = $db->selectOne('models', ['model' => $modelName]);

    if($existence['model'] === $modelName) {
      array_push($errMsg, 'Данная модель авто уже существует!');
    } else {
      
      $model = [
        'model' => $modelName,
        'main_foto' => $_POST['img'],
      ];

      $id = $db->insert('models', $model);
      $model = $db->selectOne('models', ['id' => $id]);
      header('location:index.php');
    }
  }

  public function updateModel(): void {
    
    $db = new DataB();

    treatmentImg("\assets\images\dest\models\\");

    if(isset($_POST['status'])) {
      $status = 1;
    } else {
      $status = 0;
    }

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

    $id = $_POST['id'];

    $modelId = $db->update('models', $id, $model);
    header('location:index.php');
  }

  public function deleteModel($id): void {
    $db = new DataB();
    $db->delete('models', $id);
    header('location:index.php');
  }
}

?>