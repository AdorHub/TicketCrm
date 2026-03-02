document.addEventListener('DOMContentLoaded', () => {
	const form = document.querySelector('form');
	const formMsg = document.querySelector('.form-msg');

	form.addEventListener('submit', async (e) => {
		e.preventDefault();
		document.querySelectorAll('.error-msg').forEach(el => el.remove());
		formMsg.innerHTML = '';

		const formData = new FormData(form);

		try {
			const response = await fetch(form.action, {
				method: 'POST',
				headers: {
					'Accept': 'application/json'
				},
				body: formData
			});

			if (!response.ok) {
				const data = await response.json();
				throw {
					status: response.status,
					data: data
				};
			}
			const responseData = await response.json();
			formMsg.className = 'mt-2 text-green-500 text-center text-sm';
			formMsg.innerHTML = responseData.message;
			setTimeout(() => {
				formMsg.innerHTML = '';
			}, 3000);
			form.reset();
		} catch (error) {
			if (error.status === 422 && error.data.errors) {
				for (const field in error.data.errors) {
					const input = document.querySelector(`[name=${field}]`);
					if (input) {
						const errorDiv = document.createElement('div');
						errorDiv.className = 'error-msg text-red-500 text-center mt-2';
						errorDiv.innerText = error.data.errors[field][0];
						input.parentNode.appendChild(errorDiv);
					}
				}
			} else {
				formMsg.innerText = error.data?.message || 'Произошла внутренняя ошибка';
				formMsg.className = 'text-center text-red-500 mt-4 text-sm';
				setTimeout(() => {
					formMsg.innerText = '';
				}, 3000);
			}
		}
	});
});