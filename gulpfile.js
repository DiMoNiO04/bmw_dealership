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
function scripts() {
	return src([ //Берем файлы из источников 
		'src/js/app.js'  //Пользовательские скрипты
	])
	.pipe(concat('app.min.js'))  //Конкатенируем в один файл
	.pipe(uglify())  //Сжимаем JS
	.pipe(dest('src/js/')) //Выгружаем готовый файл в папку назначения
	.pipe(browserSync.stream()) //Триггерим Browsersync для обновления страницы
}


//Обрабатываем стили
function styles() {
	return src('src/scss/main.scss')
	.pipe(sass())
	.pipe(concat('app.min.css'))
	.pipe(autoprefixer({ overrideBrowserslist: ['last 10 versions'], grid: true }))
	.pipe(cleancss(( { level: { 1: {specialComments: 0} } } )))
	.pipe(dest('src/css/'))
	.pipe(browserSync.stream())
}


//Обрабатываем изображения
async function images() {
	imagecomp(
		"src/images/src/**/*", // Берём все изображения из папки источника
		"src/images/dest/", // Выгружаем оптимизированные изображения в папку назначения
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
		'src/css/**/*.min.css',
		'src/js/**/*.min.js',
		'src/images/dest/**/*',
		'src/**/*.html',
		'src/**/*.php',
		], { base: 'src' }) // Параметр "base" сохраняет структуру проекта при копировании
	.pipe(dest('dist')) // Выгружаем в папку с финальной сборкой
}


//Очищаем папку изображений
function cleanimg() {
	return src('src/images/dest/', {allowEmpty: true}).pipe(clean()) // Удаляем папку "app/images/dest/"
}


//Очищаем сбилденную папку
function cleandist() {
	return src('dist', {allowEmpty: true}).pipe(clean()) // Удаляем папку "dist/"
}


//Следим за изменениями
function startwatch() {
	watch('src/**/*.scss', styles);
	watch(['src/**/*.js', '!src/**/*.min.js'], scripts);
	watch('src/**/*.html').on('change', browserSync.reload);
	watch('src/**/*.php').on('change', browserSync.reload);
	watch('src/images/src/**/*', images);
}


//Экспортируем функции
exports.browsersync = browsersync;
exports.scripts = scripts;
exports.styles = styles;
exports.images = images;
exports.cleanimg = cleanimg;
exports.build = series(cleandist, styles, scripts, images, buildcopy);


//Экспортируем дефолтный таск с нужным набором функций
exports.default = parallel(styles, scripts, browsersync, startwatch);