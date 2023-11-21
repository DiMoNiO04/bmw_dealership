<?php

class AutoController {

  private $AVAILABLE = 1;
  private $NO_AVAILABLE = 0;

  public function addAuto(): void {

    $db = new DataB();

    treatmentImg("\assets\images\dest\cars\\");

    $status = trim($_POST['status']);
    if(isset($_POST['status'])) {
      $status = $this -> AVAILABLE;
    } else {
      $status = $this -> $NO_AVAILABLE;
    }
      
    $auto = [
      'name' => trim($_POST['name']),
      'engine' => trim($_POST['engine']),
      'year' => trim($_POST['year']),
      'price' => trim($_POST['price']),
      'color' =>  trim($_POST['color']),
      'complexion' => trim($_POST['complexion']),
      'img' => $_POST['img'],
      'status' => $status,
      'state' => trim($_POST['state']),
      'id_model' => trim($_POST['model'])
    ];

    print_r($status);

    $auto = $db->insert('auto', $auto);
    $auto = $db->selectOne('auto', ['id' => $id]);
    header('location:index.php');
  }

  public function updateAuto(): void {
    $db = new DataB();

    treatmentImg("\assets\images\dest\cars\\");

    $status = trim($_POST['status']);
    if(isset($_POST['status'])) {
      $status = $this -> AVAILABLE;
    } else {
      $status = $this -> $NO_AVAILABLE;
    }
    
    if(empty($img)) {
      $auto = [
        'name' => trim($_POST['name']),
        'engine' => trim($_POST['engine']),
        'year' => trim($_POST['year']),
        'price' => trim($_POST['price']),
        'color' => trim($_POST['color']),
        'complexion' => trim($_POST['complexion']),
        'status' => $status,
        'id_model' => trim($_POST['model'])
      ];
    } else {
      $auto = [
        'name' => trim($_POST['name']),
        'engine' => trim($_POST['engine']),
        'year' => trim($_POST['year']),
        'price' => trim($_POST['price']),
        'color' => trim($_POST['color']),
        'complexion' => trim($_POST['complexion']),
        'img' => $_POST['img'],
        'status' => $status,
        'id_model' => trim($_POST['model'])
      ];
    }

    $id = $_POST['id'];
    $auto = $db->update('auto', $id, $auto);
    header('location:index.php');
  }

  public function updateStatusAuto($id): void {
    $db = new DataB();
    $status = $_GET['status'];
    $autoId = $db->update('auto', $id, ['status' => $status]);
    header('location:index.php');
  }

  public function deleteAuto($id): void {
    $db = new DataB();
    $db->delete('auto', $id);
    header('location:index.php');
  }
}

?>