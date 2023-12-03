<?php

class ModelService {

  public function addModel(): void {
    $db = new DataB();

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
      header('location:' . ADMIN_URL . '/model');
    }
  }

  public function updateModel(): void {
    
    $db = new DataB();

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
    header('location:' . ADMIN_URL . '/model');
  }

  public function deleteModel($id): void {
    $db = new DataB();
    $db->delete('models', $id);
    header('location:' . ADMIN_URL . '/model');
  }
}

?>