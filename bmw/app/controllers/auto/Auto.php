<?php

require('AutoController.php');
$autoController = new AutoController();


class Auto {

  public function addAuto(): void {
    global $autoController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-create']))) {
      $autoController -> addAuto();
    } 
  }

  public function updateAuto() {
    global $autoController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['id']))) {

      $db = new DataB();
      
      $id = $_GET['id'];
      $auto = $db->selectOne('auto', ['id' => $id]);

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
    global $autoController;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['auto-edit']))) {
      $autoController -> updateAuto();
    }
  }

  public function editStatusAuto(): void {
    global $autoController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['pub_id']))) {
      $id = $_GET['pub_id'];
      $autoController -> updateStatusAuto($id);
    }
  }

  public function deleteAuto(): void {
    global $autoController;

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset(($_GET['del_id']))) {
      $id = $_GET['del_id'];
      $autoController -> deleteAuto($id);
    }
  }

  public function searchAuto() {
      $db = new DataB();

      if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search__auto'])) {
    
        $priceFrom = $_POST['price__from'];
        $priceTo = $_POST['price__to'];
        $yearFrom = $_POST['year__from'];
        $yearTo = $_POST['year__to'];
        $engine = $_POST['engine'];
        $status = $_POST['status'];
        $col = $_POST['color'];
        $name = $_POST['name'];
        $complex = $_POST['complexion'];
        $state = $_POST['state'];


        if($complex == 'Комплектация:') {
          $complex = '';
        }

        if($col == 'Цвет:') {
          $col = '';
        }

        $paramsPrice = [
          'price__from' => $priceFrom,
          'price__to' => $priceTo
        ];

        $paramsYear = [
          'year__from' => $yearFrom,
          'year__to' => $yearTo
        ];

        $params = [
          'name' => $name,
          'complexion' => $complex,
          'color' => $col,
          'status' => $status,
          'engine' => $engine,
          'state' => $state
        ];

        $arrRes = 
        [
          $priceFrom, $priceTo, $yearFrom, $yearTo, $engine,
          $status, $col, $name, $complex, $state
        ];

        $autos = $db->searchAutos($params, $paramsPrice, $paramsYear);

        return [$arrRes, $autos];
      }
  }
}

// ?>