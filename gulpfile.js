//Определяем константы
const { src, dest, parallel, series, watch } = require('gulp');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleancss = require('gulp-clean-css');
const imagecomp = require('compress-images');
const clean = require('gulp-clean');

//Определяем логику работы Browsersync
function browsersync() {
  browserSync.init({
    // Инициализация Browsersync
    proxy: 'bmw', // Указываем папку сервера
    notify: false, //Отключаем уведомления
    online: true, //Режим работы
  });
}

//Обрабатываем скрипты
function jsHeader() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/header.js', //Пользовательские скрипты
  ])
    .pipe(concat('header.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

function jsPopup() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/popup.js', //Пользовательские скрипты
  ])
    .pipe(concat('popup.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

function jsValidatePassword() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/validatePassword.js', //Пользовательские скрипты
  ])
    .pipe(concat('validatePassword.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

function jsPopupPersonalEdit() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/popup-personal-edit.js', //Пользовательские скрипты
  ])
    .pipe(concat('popup-personal-edit.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

function jsService() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/service.js', //Пользовательские скрипты
  ])
    .pipe(concat('service.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

function jsSidebar() {
  return src([
    //Берем файлы из источников
    'bmw/assets/scripts/sidebar.js', //Пользовательские скрипты
  ])
    .pipe(concat('sidebar.min.js')) //Конкатенируем в один файл
    .pipe(uglify()) //Сжимаем JS
    .pipe(dest('bmw/assets/js/')) //Выгружаем готовый файл в папку назначения
    .pipe(browserSync.stream()); //Триггерим Browsersync для обновления страницы
}

//Обрабатываем стили
function styles() {
  return src('bmw/assets/styles/index.scss')
    .pipe(sass())
    .pipe(concat('style.min.css'))
    .pipe(autoprefixer({ overrideBrowserslist: ['last 10 versions'], grid: true }))
    .pipe(cleancss({ level: { 1: { specialComments: 0 } } }))
    .pipe(dest('bmw/assets/css/'))
    .pipe(browserSync.stream());
}

//Обрабатываем изображения
async function images() {
  imagecomp(
    'bmw/assets/images/src/**/*', // Берём все изображения из папки источника
    'bmw/assets/images/dest/', // Выгружаем оптимизированные изображения в папку назначения
    { compress_force: false, statistic: true, autoupdate: true },
    false, // Настраиваем основные параметры
    { jpg: { engine: 'mozjpeg', command: ['-quality', '75'] } }, // Сжимаем и оптимизируем изображеня
    { png: { engine: 'pngquant', command: ['--quality=75-100', '-o'] } },
    { svg: { engine: 'svgo', command: '--multipass' } },
    { gif: { engine: 'gifsicle', command: ['--colors', '64', '--use-col=web'] } },
    function (err, completed) {
      // Обновляем страницу по завершению
      if (completed === true) {
        browserSync.reload();
      }
    }
  );
}

//Билдим проект
function buildcopy() {
  return src(
    [
      // Выбираем нужные файлы
      'bmw/assets/css/**/*.min.css',
      'bmw/assets/js/**/*.min.js',
      'bmw/assets/images/dest/**/*',
      'bmw/assets/**/*.html',
      'bmw/assets/**/*.php',
      'bmw/app/**/*.php',
    ],
    { base: 'bmw' }
  ) // Параметр "base" сохраняет структуру проекта при копировании
    .pipe(dest('dist')); // Выгружаем в папку с финальной сборкой
}

//Очищаем папку изображений
function cleanimg() {
  return src('bmw/assets/images/dest/', { allowEmpty: true }).pipe(clean()); // Удаляем папку "app/images/dest/"
}

//Очищаем сбилденную папку
function cleandist() {
  return src('dist', { allowEmpty: true }).pipe(clean()); // Удаляем папку "dist/"
}

//Следим за изменениями
function startwatch() {
  watch('bmw/assets/**/*.scss', styles);
  watch(['bmw/assets/scripts/header.js', '!bmw/assets/scripts/header.min.js'], jsHeader);
  watch(['bmw/assets/scripts/popup.js', '!bmw/assets/scripts/popup.min.js'], jsPopup);
  watch(['bmw/assets/scripts/service.js', '!bmw/assets/scripts/service.min.js'], jsService);
  watch(['bmw/assets/scripts/sidebar.js', '!bmw/assets/scripts/sidebar.min.js'], jsSidebar);
  watch(['bmw/assets/scripts/sidebar.js', '!bmw/assets/scripts/validatePassword.min.js'], jsValidatePassword);
  watch(['bmw/assets/scripts/sidebar.js', '!bmw/assets/scripts/popup-personal-edit.min.js'], jsPopupPersonalEdit);
  watch('bmw/assets/**/*.html').on('change', browserSync.reload);
  watch('bmw/assets/**/*.php').on('change', browserSync.reload);
  watch('bmw/app/**/*.php').on('change', browserSync.reload);
  watch('bmw/assets/images/src/**/*', images);
}

//Экспортируем функции
exports.browsersync = browsersync;
exports.jsHeader = jsHeader;
exports.jsPopup = jsPopup;
exports.jsValidatePassword = jsValidatePassword;
exports.jsPopupPersonalEdit = jsPopupPersonalEdit;
exports.jsService = jsService;
exports.jsSidebar = jsSidebar;
exports.styles = styles;
exports.images = images;
exports.cleanimg = cleanimg;
exports.build = series(
  cleandist,
  styles,
  jsHeader,
  jsPopup,
  jsValidatePassword,
  jsService,
  jsSidebar,
  jsPopupPersonalEdit,
  images,
  buildcopy
);

//Экспортируем дефолтный таск с нужным набором функций
exports.default = parallel(
  styles,
  jsHeader,
  jsPopup,
  jsValidatePassword,
  jsPopupPersonalEdit,
  jsService,
  jsSidebar,
  browsersync,
  startwatch
);
