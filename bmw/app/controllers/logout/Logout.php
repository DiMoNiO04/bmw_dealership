<?php 

include('../../../path.php');

class LogOut {

  private function clearSession():void {
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['admin']);
  }

  private function redirectMain(): void {
    header('location:' . BASE_URL);
  }

  public function out(): void {
    $this->clearSession();
    $this->redirectMain();
  }
}

?>