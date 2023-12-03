<?php 

abstract class PersonService {

  protected $ACCESS = 1;
  protected $NO_ACCESS = 0;
  protected $ADMIN = 1;
	protected $CLIENT = 0;
  public $errMsg = [];

  protected function add() {}

  protected function update(): void {}

  protected function updateStatus($id): void {}

  protected function delete($id): void {}

}

?>