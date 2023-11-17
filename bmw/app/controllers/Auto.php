<?php

include SITE_ROOT . "/app/helps/treatmentImage.php";

require('AutoActions.php');
$autoActions = new AutoActions();


class Auto {

  public function addAuto(): void {
    global $autoActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-create']))) {
      $autoActions -> addAuto();
    } 
  }

  public function updateAuto() {
    global $autoActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();
      
      $id = $_GET['id']; //Получаем айди, того кого хотим изменить 
      $auto = $db->selectOne('auto', ['id' => $id]); //Получаем все данные можели, которую хотим изменить

      //Получаем данные авто которого хотим изменить в переменные
      $id = $auto['id'];
      $name = $auto['name'];
      $complexion = $auto['complexion'];
      $color = $auto['color'];
      $year = $auto['year'];
      $engine = $auto['engine'];
      $price = $auto['price'];
      $status = $auto['status'];
      $img = $auto['img'];
      $model = $auto['id_model'];

      $arrRes = [$id, $name, $complexion, $color, $year, $engine, $price, $status, $img, $model];
      return $arrRes;
    }
  }

  public function editAuto(): void {
    global $autoActions;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-edit']))) {
      $autoActions -> updateAuto();
    }
  }

  public function editStatusAuto(): void {
    global $autoActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id'];  //Получаем айди автомобиля, который хотим измнить
      $autoActions -> updateStatusAuto($id);
    }
  }

  public function deleteAuto(): void {
    global $autoActions;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];  //Получаем айди авто, которую хотим удалить
      $autoActions -> deleteAuto($id);
    }
  }
}

// ?>