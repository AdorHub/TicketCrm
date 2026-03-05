(function () {
	const sidebar = document.getElementById('sidebar');
	const contentDiv = document.getElementById('content');
	const toggleBtn = document.getElementById('toggleBtn');
	const logoContainer = document.getElementById('logo-container');
	const logoText = document.getElementById('logo-text');

	toggleBtn.onclick = () => {
		sidebar.classList.toggle('w-16');
		sidebar.classList.toggle('w-64');
		logoContainer.classList.toggle('hidden');
		logoText.classList.toggle('hidden');

		const sidebarLinks = sidebar.querySelectorAll('a');

		sidebarLinks.forEach(link => {
			if (sidebar.classList.contains('w-64')) {
				link.classList.remove('hidden');
				contentDiv.classList.remove('ml-0');
				contentDiv.classList.add('ml-64');
			} else {
				link.classList.add('hidden');
				contentDiv.classList.remove('ml-64');
				contentDiv.classList.add('ml-0');
			}
		});
	};

	function handleResize() {
		if (window.innerWidth < 768) {
			sidebar.classList.add('w-16');
			sidebar.classList.remove('w-64');
			logoContainer.classList.add('hidden');
			logoText.classList.add('hidden');
			contentDiv.classList.remove('ml-64');
			contentDiv.classList.add('ml-16');
		} else {
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