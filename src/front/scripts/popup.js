const BUTTON_ORDER_MAIN = document.querySelector('.button__order__auto');
const BUTTON_ORDER = document.querySelector('.button__order');
const CLOSE_BUTTON = document.querySelector('.order__close')
const POPUP = document.querySelector('.popup')
const DARK_CONTAINER = document.querySelector('.dark__container');


const togglePopupDark = () => {
	POPUP.classList.toggle('popup__hidden')
	DARK_CONTAINER.classList.toggle('dark__container__noactive')
}

BUTTON_ORDER_MAIN.addEventListener('click', togglePopupDark);
BUTTON_ORDER.addEventListener('click', togglePopupDark);
CLOSE_BUTTON.addEventListener('click', togglePopupDark);

POPUP.addEventListener('click', (event) => {
	if( event.target.classList.contains('popup') ){
		togglePopupDark();
	}
})