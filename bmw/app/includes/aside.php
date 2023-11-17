<?php 
	include('../../path.php');
	$job = $db->selectOne('employees', ['id_auth' => $_SESSION['id']])['job'];
?>

<aside class="sidebar">
	<ul class=sidebar__items>
		<?php if($job == 'Админ'):?>
			<li><a href="<?= BASE_URL . "admin/clientss/index.php" ?>">Клиенты</a></li>
			<li><a href="<?= BASE_URL . "admin/employees/index.php" ?>">Сотрудники</a></li>
			<li><a href="<?= BASE_URL . "admin/contacts/index.php" ?>">Контакты</a></li>
		<?php else: ?>
			<li><a href="<?= BASE_URL . "admin/autos_models/index.php" ?>">Модели</a></li>
			<li><a href="<?= BASE_URL . "admin/autos/index.php" ?>">Автомобили</a></li>
			<li><a href="<?= BASE_URL . "admin/orders/index.php" ?>">Заказы</a></li>
		<?php endif; ?>
	</ul>
</aside>