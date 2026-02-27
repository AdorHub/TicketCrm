document.addEventListener('DOMContentLoaded', () => {
	const message = document.querySelector('.success-msg');
	if (message) {
		setTimeout(() => {
			message.style.display = 'none';
		}, 3000);
	}
});