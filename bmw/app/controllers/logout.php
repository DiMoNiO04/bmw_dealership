<?php 

class LogOut {

  //Удаляем сессию
  private function clearSession():void {
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['admin']);
  }

  //Редирект на главную страницу
  private function redirectMain(): void {
    header('location:/bmw/');
  }

  public function out(): void {
    $this->clearSession();
    $this->redirectMain();
  }
}

?>