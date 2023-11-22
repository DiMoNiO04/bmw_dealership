<?php 
  $job = $db->selectOne('employees', ['id_auth' => $_SESSION['id']])['job'];
?>

<aside class="sidebar">
  <ul class=sidebar__items>
    <?php if($job == 'Админ'):?>
      <li><a href="<?= BASE_URL ?>/admin/client">Клиенты</a></li>
      <li><a href="<?= BASE_URL ?>/admin/employee">Сотрудники</a></li>
      <li><a href="<?= BASE_URL ?>/admin/contact">Контакты</a></li>
    <?php else: ?>
      <li><a href="<?= BASE_URL ?>/admin/model">Модели</a></li>
      <li><a href="<?= BASE_URL ?>/admin/auto">Автомобили</a></li>
      <li><a href="<?= BASE_URL ?>/admin/order">Заказы</a></li>
    <?php endif; ?>
  </ul>
</aside>