//Активная ссылка в сайдбаре
const SIDEBAR = document.querySelector('.sidebar__list');
const SIDEBAR_ITEMS = document.querySelectorAll('.sidebar__item');
const MODEL_CARS = document.querySelectorAll('.model__cars-js');
const ERROR = document.querySelector('.error');

const sidebarAddRemove = (index) => {
	for(let i = 0; i<SIDEBAR_ITEMS.length; i++){
		SIDEBAR_ITEMS[i].classList.remove('sidebar__item-active')
	}
	SIDEBAR_ITEMS[index].classList.add('sidebar__item-active')
}

SIDEBAR.addEventListener('click',  e => {
	let id = e.target.id
	for(let i = 0; i < SIDEBAR_ITEMS.length; i++){
		SIDEBAR_ITEMS[i].classList.remove('sidebar__item-active')
	}
	SIDEBAR_ITEMS[id].classList.add('sidebar__item-active')

	model = SIDEBAR_ITEMS[id].getAttribute("model")



	let isHave = false;
	if(model == 'all') {
		for(let i = 0; i < MODEL_CARS.length; i++) {
			MODEL_CARS[i].style.display = 'flex';
			isHave = true;
		}	
	} else {		
		for(let i = 0; i < MODEL_CARS.length; i++) {
			if(MODEL_CARS[i].getAttribute('model') != model) {
				MODEL_CARS[i].style.display = 'none';
			} else {
				MODEL_CARS[i].style.display = 'flex';
				isHave = true;
			}
		}
	}
	
	if(isHave === false) {
		ERROR.innerHTML = 'Авто данной модели нет в наличии!';
	} else {
		ERROR.innerHTML = '';
	}
})

