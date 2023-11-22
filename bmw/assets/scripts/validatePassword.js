document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.password-form')) {
    const FORM_PASSWORD = document.querySelector('.password-form');
    const ERROR = document.querySelector('.error');
    const PASSWORD_FIRST = document.getElementById('passF');
    const PASSWORD_SECOND = document.getElementById('passS');

    FORM_PASSWORD.addEventListener('submit', (event) => {
      if (PASSWORD_FIRST.value !== PASSWORD_SECOND.value) {
        ERROR.innerHTML = 'Пароли должны совпадать!';
        event.preventDefault();
      }
    });
  }
});
