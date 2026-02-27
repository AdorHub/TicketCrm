(function () {
	const sidebar = document.getElementById('sidebar');
	const contentDiv = document.getElementById('content');
	const toggleBtn = document.getElementById('toggleBtn');
	const logoContainer = document.getElementById('logo-container');
	const logoText = document.getElementById('logo-text');

	// Обработчик кнопки
	toggleBtn.onclick = () => {
		// Переключение ширины сайдбара
		sidebar.classList.toggle('w-16');
		sidebar.classList.toggle('w-64');

		// Скрыв-раскрыв логотип
		logoContainer.classList.toggle('hidden');
		logoText.classList.toggle('hidden');

		// Смещение основного контента
		if (sidebar.classList.contains('w-16')) {
			contentDiv.classList.remove('ml-64');
			contentDiv.classList.add('ml-0');
		} else {
			contentDiv.classList.remove('ml-0');
			contentDiv.classList.add('ml-64');
		}
	};

	// Обработка при resize окна
	function handleResize() {
		if (window.innerWidth < 768) {
			// Мобильный режим — сворачиваем
			sidebar.classList.add('w-16');
			sidebar.classList.remove('w-64');
			logoContainer.classList.add('hidden');
			logoText.classList.add('hidden');
			contentDiv.classList.remove('ml-64');
			contentDiv.classList.add('ml-16');
		} else {
			// Десктоп — всегда раскрыт
			sidebar.classList.remove('w-16');
			sidebar.classList.add('w-64');
			logoContainer.classList.remove('hidden');
			logoText.classList.remove('hidden');
			contentDiv.classList.remove('ml-16');
			contentDiv.classList.add('ml-64');
		}
	}

	window.addEventListener('resize', handleResize);
	handleResize();
})();