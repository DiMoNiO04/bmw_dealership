const BUTTON_ORDER_MAIN = document.querySelector('.button__order__auto');
const BUTTON_ORDER = document.querySelector('.button__order');
const CLOSE_BUTTON = document.querySelector('.popup__close');
const POPUP = document.querySelector('.popup');
const DARK_CONTAINER = document.querySelector('.dark__container');
const BODY = document.body;

const togglePopupDark = () => {
  POPUP.classList.toggle('popup__hidden');
  DARK_CONTAINER.classList.toggle('dark__container__noactive');
  BODY.classList.toggle('body__hidden');
};

const isContainsPopup = (event) => event.target.classList.contains('popup');

BUTTON_ORDER_MAIN.addEventListener('click', togglePopupDark);
BUTTON_ORDER.addEventListener('click', togglePopupDark);
CLOSE_BUTTON.addEventListener('click', togglePopupDark);

POPUP.addEventListener('click', () => {
  if (isContainsPopup()) {
    togglePopupDark();
  }
});
