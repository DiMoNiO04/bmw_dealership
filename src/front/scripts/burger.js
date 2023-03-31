const burger = document.querySelector('.header__burger');
const burgerMenu = document.querySelector('.burger__menu');
const darkBody = document.querySelector('.dark-wrapper');

const toggleClass = () => {
	burgerMenu.classList.toggle('burger__menu-active');
	burger.classList.toggle('header__burger-active');
	darkBody.classList.toggle('dark-wrapper-active');
}

const isContainsDark = () => event.target.classList.contains('dark-wrapper');

burger.addEventListener('click', toggleClass);

document.addEventListener('click', (event) => {
	if(isContainsDark()) {
		toggleClass();
	}
})