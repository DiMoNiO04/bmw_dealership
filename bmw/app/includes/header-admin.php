<?php 
	include SITE_ROOT . '/path.php';
	$db = new DataB();
	$job = $db->selectOne('employees', ['id_auth' => $_SESSION['id']])['job'];
?>

<header class="header header-blue">
		<div class="container">
			<div class="header__container header-blue__container">
				<nav class="header__menu">
					<ul class="header__list">
						<li class="header__item"><a class="header__item-link" href="../../autos.php">Автомобили</a></li>
						<li class="header__item"><a class="header__item-link" href="../../about.php">О компании</a></li>
						<li class="header__item"><a class="header__item-link" href="../../service.php">Услуги</a></li>
						<li class="header__item"><a class="header__item-link" href="../../contacts.php">Контакты</a></li>
					</ul>
				</nav>
				<div class="header__active">
					<div class="header__cab">
						<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i><?php echo $_SESSION['login']; ?></button>
						<ul class="header__logout">
								<li class="header__item"><a class="header__logout-link" href="../../personal__cab-user.php">Личный кабинет</a></li>
								
								<?php if($job == 'Админ'):?>
									<li class="header__item"><a class="header__logout-link" href="../../admin/clientss/index.php">Админ панель</a></li>
								<?php else: ?>
									<li class="header__item"><a class="header__logout-link" href="../../admin/autos_models/index.php">Менеджер панель</a></li>
								<?php endif; ?>
								
								<li class="header__item"><a class="header__logout-link" href="../../logout.php">Выход</a></li>
						</ul>
					</div>
					<a href="../../index.php" class="logo-bmw">
						<img src="../../assets/images/dest/svg/bmw_logo.svg" alt="Logo_BMW">
					</a>
					<div class="header__burger">
						<span class="header__burger-line"></span>
						<span class="header__burger-line"></span>
						<span class="header__burger-line"></span>
					</div>
				</div>
				
				<div class="burger__menu">
					<nav class="burger__menu-nav">
						<ul class="header__list">
							<li class="header__item"><a class="header__item-link" href="../../autos.php">Автомобили</a></li>
							<li class="header__item"><a class="header__item-link" href="../../about.php">О компании</a></li>
							<li class="header__item"><a class="header__item-link" href="../../service.php">Услуги</a></li>
							<li class="header__item"><a class="header__item-link" href="../../contacts.php">Контакты</a></li>
						</ul>
					</nav>
					<div class="header__cab">

						<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i><?php echo $_SESSION['login']; ?></button>

						<ul class="header__logout">
							<li class="header__item"><a class="header__logout-link" href="../../personal__cab-user.php">Личный кабинет</a></li>

							<?php if($job == 'Админ'):?>
								<li class="header__item"><a class="header__logout-link" href="../../admin/clientss/index.php">Админ панель</a></li>
							<?php else: ?>
								<li class="header__item"><a class="header__logout-link" href="../../admin/autos_models/index.php">Менеджер панель</a></li>
							<?php endif; ?>

							<li class="header__item"><a class="header__logout-link" href="../../logout.php">Выход</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>