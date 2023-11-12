
document.addEventListener('click', (event) => {
	console.log(event.target.classList.value)
})

//На странице услуги и сервис изменение значков плюс и минус
const coll = document.querySelectorAll('.services__collapsible')
const icon = document.querySelectorAll('.fa-plus')

for(let i = 0; i < coll.length; i++){
	coll[i].addEventListener('click', function(){
		let content = this.nextElementSibling;
		if(content.style.maxHeight){
			content.style.maxHeight = null;
			icon[i].classList.remove('fa-minus');
			icon[i].classList.add('fa-plus')
		}else{
			content.style.maxHeight = content.scrollHeight + 'px';
			icon[i].classList.remove('fa-plus');
			icon[i].classList.add('fa-minus')
		}
	})
}