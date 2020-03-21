const text = document.querySelector('.label-text');
const input = document.querySelector('.inputfile');
const label = document.querySelector('.label-wrap');

input.addEventListener('change', () => {
		text.innerHTML = "Выбран файл";
		label.style.backgroundColor = "#888";
		label.style.border = "2px soild black";
});