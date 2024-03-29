document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.popup__personal-data')) {
    const POPUP_PERSONAL = document.querySelector('.popup__personal-data');
    const CLOSE_BUTTON_PASSWORD = document.querySelector('.popup__close-password');
    const POPUP_PASSWORD = document.querySelector('.popup__password');
    const DARK_CONTAINER = document.querySelector('.dark__container');
    const PASSWORD_EDIT = document.querySelector('.personal-password__edit');
    const CLOSE_BUTTON_PERSONAL = document.querySelector('.popup__close-personal');
    const PERSONAL_EDIT = document.querySelector('.button__personal-data');
    const BODY = document.body;

    const isContainsPopup = (event) => event.target.classList.contains('popup');

    const togglePopupDarkPassword = () => {
      POPUP_PASSWORD.classList.toggle('popup__hidden');
      DARK_CONTAINER.classList.toggle('dark__container__noactive');
      BODY.classList.toggle('body__hidden');
    };

    CLOSE_BUTTON_PASSWORD.addEventListener('click', togglePopupDarkPassword);
    PASSWORD_EDIT.addEventListener('click', togglePopupDarkPassword);

    POPUP_PASSWORD.addEventListener('click', () => {
      if (isContainsPopup()) {
        togglePopupDarkPassword();
      }
    });

    const togglePopupDarkPersonal = () => {
      POPUP_PERSONAL.classList.toggle('popup__hidden');
      DARK_CONTAINER.classList.toggle('dark__container__noactive');
      BODY.classList.toggle('body__hidden');
    };

    CLOSE_BUTTON_PERSONAL.addEventListener('click', togglePopupDarkPersonal);
    PERSONAL_EDIT.addEventListener('click', togglePopupDarkPersonal);
  }
});
