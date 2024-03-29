document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.services__collapsible')) {
    const coll = document.querySelectorAll('.services__collapsible');
    const icon = document.querySelectorAll('.fa-plus');

    for (let i = 0; i < coll.length; i += 1) {
      coll[i].addEventListener('click', function () {
        const content = this.nextElementSibling;
        if (content.style.maxHeight) {
          content.style.maxHeight = null;
          icon[i].classList.remove('fa-minus');
          icon[i].classList.add('fa-plus');
        } else {
          content.style.maxHeight = `${content.scrollHeight}px`;
          icon[i].classList.remove('fa-plus');
          icon[i].classList.add('fa-minus');
        }
      });
    }
  }
});
