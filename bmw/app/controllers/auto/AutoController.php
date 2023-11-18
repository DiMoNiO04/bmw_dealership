<?php

class AutoController {

  private $AVAILABLE = 1;
  private $NO_AVAILABLE = 0;

  public function addAuto(): void {

    $db = new DataB();

    //Работа с изображением
    treatmentImg("\assets\images\dest\cars\\");

    //Проверяем статус: выбран или нет
    $status = trim($_POST['status']);
    if(isset($_POST['status'])) {
      $status = $this -> AVAILABLE;
    } else {
      $status = $this -> $NO_AVAILABLE;
    }
      
    //Формируем массив для отправки
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

    $auto = $db->insert('auto', $auto); //Отправляем данные в таблицу auti
    $auto = $db->selectOne('auto', ['id' => $id]); //Получаем данные добавленной модели
    header('location:index.php'); //Возвращаем на страницу автомобилей
  }

  public function updateAuto(): void {
    $db = new DataB();

    //Работа с изображением 
    treatmentImg("\assets\images\dest\cars\\");

    //Проверяем статус: выбран или нет
    $status = trim($_POST['status']);
    if(isset($_POST['status'])) {
      $status = $this -> AVAILABLE;
    } else {
      $status = $this -> $NO_AVAILABLE;
    }
    
    //Формируем массив для отправки
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

    $id = $_POST['id']; //Получаем айди автомобиля, который хотим изменить
    $auto = $db->update('auto', $id, $auto); //Обновляем данные автомобиля
    header('location:index.php'); //Возвращаем на страницу автомобилей
  }

  public function updateStatusAuto($id): void {
    $db = new DataB();
    $status = $_GET['status']; //Получаем статус автомобиля, который хотим измнитьб
    $autoId = $db->update('auto', $id, ['status' => $status]); //Перезаписываем полученную запись
    header('location:index.php'); //Возвращаем на страницу моделей
  }

  public function deleteAuto($id): void {
    $db = new DataB();
    $db->delete('auto', $id); //Удаляем авто
    header('location:index.php'); //Возвращаем на страницу авто
  }
}

?>