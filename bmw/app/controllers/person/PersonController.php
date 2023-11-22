<?php 

abstract class PersonController {

	private $ACCESS = 1;
  private $NO_ACCESS = 0;
  private $ADMIN = 1;
  public $errMsg = [];

	protected function add() {}

	protected function update(): void {}

	protected function updateStatus($id): void {}

	protected function delete($id): void {}

}

?>