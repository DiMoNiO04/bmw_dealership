const ERROR = document.querySelector('.error');
const PASSWORD_FIRST = document.getElementById('passF');
const PASSWORD_SECOND = document.getElementById('passS');
const FORM_PASSWORD = document.querySelector('.password-form');

console.log(ERROR)
console.log(FORM_PASSWORD)

FORM_PASSWORD.addEventListener('submit', function(event) {
	if(PASSWORD_FIRST.value !== PASSWORD_SECOND.value) {
		ERROR.innerHTML = 'Пароли должны совпадать!';
		event.preventDefault()
	}
})