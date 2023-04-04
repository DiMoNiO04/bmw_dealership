<header class="header">
		<div class="container">
			<div class="header__container">
				<nav class="header__menu">
					<ul class="header__list">
						<li class="header__item"><a class="header__item-link" href="autos.php">Автомобили</a></li>
						<li class="header__item"><a class="header__item-link" href="about.php">О компании</a></li>
						<li class="header__item"><a class="header__item-link" href="service.php">Услуги</a></li>
						<li class="header__item"><a class="header__item-link" href="contacts.php">Контакты</a></li>
					</ul>
				</nav>
				<div class="header__active">
					<div class="header__cab">

						<?php if(isset($_SESSION['id'])):?>
							<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i><?php echo $_SESSION['login']; ?></button>
						<?php else: ?>
							<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i>Кабинет</button>
						<?php endif; ?>

						<ul class="header__logout">

							<?php if(isset($_SESSION['id'])):?>
								<li class="header__item"><a class="header__logout-link" href="personal__cab-user.php">Личный кабинет</a></li>
								<?php if($_SESSION['role']): ?>
									<li class="header__item"><a class="header__logout-link" href="admin__panel.php">Админ панель</a></li>
								<?php endif; ?>
								<li class="header__item"><a class="header__logout-link" href="logout.php">Выход</a></li>
							<?php else: ?>
								<li class="header__item"><a class="header__logout-link" href="auth.php">Войти</a></li>
								<li class="header__item"><a class="header__logout-link" href="reg.php">Зарегистрироваться</a></li>
							<?php endif; ?>
						</ul>

					</div>
					<a href="index.php" class="logo-bmw">
						<img src="./assets/images/dest/svg/bmw_logo.svg" alt="Logo_BMW">
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
							<li class="header__item"><a class="header__item-link" href="autos.php">Автомобили</a></li>
							<li class="header__item"><a class="header__item-link" href="about.php">О компании</a></li>
							<li class="header__item"><a class="header__item-link" href="service.php">Услуги</a></li>
							<li class="header__item"><a class="header__item-link" href="contacts.php">Контакты</a></li>
						</ul>
					</nav>
					<div class="header__cab">	
						
					<?php if(isset($_SESSION['id'])):?>
							<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i><?php echo $_SESSION['login']; ?></button>
						<?php else: ?>
							<button class="header__cab-button" href="#"><i class="fa-solid fa-user"></i>Кабинет</button>
						<?php endif; ?>
						
						<ul class="header__logout">
						
							<?php if(isset($_SESSION['id'])):?>
								<li class="header__item"><a class="header__logout-link" href="personal__cab-user.php">Личный кабинет</a></li>
								<?php if($_SESSION['role']): ?>
									<li class="header__item"><a class="header__logout-link" href="admin__panel.php">Админ панель</a></li>
								<?php endif; ?>
								<li class="header__item"><a class="header__logout-link" href="logout.php">Выход</a></li>
							<?php else: ?>
								<li class="header__item"><a class="header__logout-link" href="auth.php">Войти</a></li>
								<li class="header__item"><a class="header__logout-link" href="reg.php">Зарегистрироваться</a></li>
							<?php endif; ?>
						
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>