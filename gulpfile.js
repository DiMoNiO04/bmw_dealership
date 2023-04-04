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
	browserSync.init({  // Инициализация Browsersync
		proxy: "bmw",    // Указываем папку сервера
		notify: false,   //Отключаем уведомления
		online: true     //Режим работы
	})
}


//Обрабатываем скрипты
function jsHeader() {
	return src([ //Берем файлы из источников 
		'src/assets/scripts/header.js'  //Пользовательские скрипты
	])
	.pipe(concat('header.min.js'))  //Конкатенируем в один файл
	.pipe(uglify())  //Сжимаем JS
	.pipe(dest('src/assets/js/')) //Выгружаем готовый файл в папку назначения
	.pipe(browserSync.stream()) //Триггерим Browsersync для обновления страницы
}

function jsPopup() {
	return src([ //Берем файлы из источников 
		'src/assets/scripts/popup.js'  //Пользовательские скрипты
	])
	.pipe(concat('popup.min.js'))  //Конкатенируем в один файл
	.pipe(uglify())  //Сжимаем JS
	.pipe(dest('src/assets/js/')) //Выгружаем готовый файл в папку назначения
	.pipe(browserSync.stream()) //Триггерим Browsersync для обновления страницы
}

function jsService() {
	return src([ //Берем файлы из источников 
		'src/assets/scripts/service.js'  //Пользовательские скрипты
	])
	.pipe(concat('service.min.js'))  //Конкатенируем в один файл
	.pipe(uglify())  //Сжимаем JS
	.pipe(dest('src/assets/js/')) //Выгружаем готовый файл в папку назначения
	.pipe(browserSync.stream()) //Триггерим Browsersync для обновления страницы
}

function jsSidebar() {
	return src([ //Берем файлы из источников 
		'src/assets/scripts/sidebar.js'  //Пользовательские скрипты
	])
	.pipe(concat('sidebar.min.js'))  //Конкатенируем в один файл
	.pipe(uglify())  //Сжимаем JS
	.pipe(dest('src/assets/js/')) //Выгружаем готовый файл в папку назначения
	.pipe(browserSync.stream()) //Триггерим Browsersync для обновления страницы
}


//Обрабатываем стили
function styles() {
	return src('src/assets/styles/index.scss')
	.pipe(sass())
	.pipe(concat('style.min.css'))
	.pipe(autoprefixer({ overrideBrowserslist: ['last 10 versions'], grid: true }))
	.pipe(cleancss(( { level: { 1: {specialComments: 0} } } )))
	.pipe(dest('src/assets/css/'))
	.pipe(browserSync.stream())
}


//Обрабатываем изображения
async function images() {
	imagecomp(
		"src/assets/images/src/**/*", // Берём все изображения из папки источника
		"src/assets/images/dest/", // Выгружаем оптимизированные изображения в папку назначения
		{ compress_force: false, statistic: true, autoupdate: true }, false, // Настраиваем основные параметры
		{ jpg: { engine: "mozjpeg", command: ["-quality", "75"] } }, // Сжимаем и оптимизируем изображеня
		{ png: { engine: "pngquant", command: ["--quality=75-100", "-o"] } },
		{ svg: { engine: "svgo", command: "--multipass" } },
		{ gif: { engine: "gifsicle", command: ["--colors", "64", "--use-col=web"] } },
		function (err, completed) { // Обновляем страницу по завершению
			if (completed === true) {
				browserSync.reload()
			}
		}
	)
}


//Билдим проект
function buildcopy() {
	return src([ // Выбираем нужные файлы
		'src/assets/css/**/*.min.css',
		'src/assets/js/**/*.min.js',
		'src/assets/images/dest/**/*',
		'src/assets/**/*.html',
		'src/assets/**/*.php',
		'src/app/**/*.php',
		], { base: 'src' }) // Параметр "base" сохраняет структуру проекта при копировании
	.pipe(dest('dist')) // Выгружаем в папку с финальной сборкой
}


//Очищаем папку изображений
function cleanimg() {
	return src('src/assets/images/dest/', {allowEmpty: true}).pipe(clean()) // Удаляем папку "app/images/dest/"
}


//Очищаем сбилденную папку
function cleandist() {
	return src('dist', {allowEmpty: true}).pipe(clean()) // Удаляем папку "dist/"
}


//Следим за изменениями
function startwatch() {
	watch('src/assets/**/*.scss', styles);
	watch(['src/assets/scripts/header.js', '!src/assets/scripts/header.min.js'], jsHeader);
	watch(['src/assets/scripts/popup.js', '!src/assets/scripts/popup.min.js'], jsPopup);
	watch(['src/assets/scripts/service.js', '!src/assets/scripts/service.min.js'], jsService);
	watch(['src/assets/scripts/sidebar.js', '!src/assets/scripts/sidebar.min.js'], jsSidebar);
	watch('src/assets/**/*.html').on('change', browserSync.reload);
	watch('src/assets/**/*.php').on('change', browserSync.reload);
	watch('src/app/**/*.php').on('change', browserSync.reload);
	watch('src/assets/images/src/**/*', images);
}


//Экспортируем функции
exports.browsersync = browsersync;
exports.jsHeader = jsHeader;
exports.jsPopup = jsPopup;
exports.jsService = jsService;
exports.jsSidebar = jsSidebar;
exports.styles = styles;
exports.images = images;
exports.cleanimg = cleanimg;
exports.build = series(cleandist, styles, jsHeader, jsPopup, jsService, jsSidebar, images, buildcopy);


//Экспортируем дефолтный таск с нужным набором функций
exports.default = parallel(styles, jsHeader, jsPopup, jsService, jsSidebar, browsersync, startwatch);