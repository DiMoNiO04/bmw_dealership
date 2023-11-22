<?php 
  include ('../path.php'); 
  include (SITE_ROOT . '/app/database/DataB.php');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
 	<?php include('../app/includes/head.php') ?>
  <title>О компании-BMW</title>
</head>

<body>
  
  <?php include(SITE_ROOT . '/app/includes/header-blue.php') ?>

  <div class="dark-wrapper"></div>
  <main>
    <section class="company">
      <div class="container">
        <div class="company__container">
          <div class="company__shop">
            <h1 class="shop__title"><span>ООО «Автоидея»</span> - официальный дилер BMW и MINI в Беларуси.</h1>
            <p>Автоцентр "Автоидея" - это один из самых больших, современных и инновационных дилерских центров в
              Восточной Европе.</p>
            <p>АВТОИДЕЯ - официальный дилер BMW и MINI в Республике Беларусь c 2007 года.
              ООО «АВТОИДЕЯ» осуществляет деятельность в сфере продажи и обслуживания легковых автомобилей и мотоциклов</p>
            <p><span>Преимущества сервисной станции и кузовного цеха "Автоидея":</span></p>
            <ul class="shop__list">
              <li><i class="fa-solid fa-check"></i>Гарантированное качество работ и материалов за справедливую цену.</li>
              <li><i class="fa-solid fa-check"></i>Сертифицированные специалисты, которые максимально осведомлены о вашем автомобиле, постоянно
                перенимают самые последние разработки немецких коллег из BMW Group и могут получить моментальную
                консультацию именной по вашему BMW/MINI прямо на заводе.</li>
              <li><i class="fa-solid fa-check"></i>Диагностика и обслуживание вашего автомобиля осуществляется с помощью самого современно и
                инновационного оборудования, аналогов которого нет в Беларуси.</li>
              <li><i class="fa-solid fa-check"></i>В "Автоидея" используются только оригинальные запасные части и расходные материалы с гарантией
                2 года.</li>
              <li><i class="fa-solid fa-check"></i>Помимо комфортабельной зоны ожидания (ТV, Internet, планшеты, пресса, напитки, wi-fi) в
                "Автоидея" вы можете воспользоваться услугой "Ваш офис в Автоидея" (отдельное помещение, wi-fi,
                услуги секретаря, канцтовары).</li>
              <li><i class="fa-solid fa-check"></i>"Автоидея" регулярно предлагает своим клиентам специальные сезонные предложения сервиса на
                особенно привлекательных условиях.</li>
              <li><i class="fa-solid fa-check"></i>Международные программы BMW: возможность приобретения комплексных сервисных пакетов и
                ремонтного пакета (аналог продленной гарантии) по выгодной цене.</li>
              <li><i class="fa-solid fa-check"></i>После кузовного ремонта в "Автоидея" ваш автомобиль будет таким же, каким он был до
                происшествия.</li>
              <li><i class="fa-solid fa-check"></i>При работе над вашим автомобилем будут использоваться передовые европейские технологии,
                направленные на максимальную безопасность и безупречный внешний вид вашего автомобиля.</li>
              <li><i class="fa-solid fa-check"></i>Поставка запасных частей осуществляется в срок от 11 дней.</li>
              <li><i class="fa-solid fa-check"></i>Мы прикладываем максимум усилий, чтобы сделать процесс приемки и отдачи автомобиля максимально
                комфортным и оперативным для Вас.</li>
            </ul>
          </div>
          <ul class="company__links">
            <li class="company__link">
              <h2 class="link__title">Ознакомиться с услугами</h2>
              <a class="button company-button" href="./service.php" title="Услуги">Подробнее</a>
            </li>
            <li class="company__link">
              <h2 class="link__title">Ознакомиться с контактами</h2>
              <a class="button company-button" href="./contacts.php" title="Контакты">Подробнее</a>
            </li>
            <li class="company__link">
              <h2 class="link__title">Ознакомиться с автомобилимя</h2>
              <a class="button company-button" href="./autos.php" title="Автомобили">Подробнее</a></button>
            </li>
          </ul>
          <div class="company__data">
            <h2 class="company__title">Данные компании</h2>
            <p>Этот веб-сайт обслуживается Bayerische Motoren Werke Aktiengesellschaft (Petuelring 130, 80788
              Munich, Germany).</p>
            <p>Электронные контактные данные: <span>customer.service@bmw.com</span>.</p>
            <p>Импортёр: UAB Autoimex (Žalgirio g. 112A, LT-09300 Vilnius. Lithuania).</p>
            <p>Электронные контактные данные: <span>info@bmw.by</span></p>
            <p>Код предприятия: 300662220</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include(SITE_ROOT . '/app/includes/footer.php') ?>
	<?php include(SITE_ROOT . '/app/includes/script.php') ?>
</body>

</html>