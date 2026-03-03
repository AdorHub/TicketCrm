document.addEventListener("DOMContentLoaded", () => {
	fetch('/api/tickets/statistics')
		.then(res => res.json())
		.then(data => {
			document.getElementById('today-count').innerText = data.stats.today;
			document.getElementById('week-count').innerText = data.stats.this_week;
			document.getElementById('month-count').innerText = data.stats.this_month;
			document.getElementById('total-count').innerText = data.stats.total;

			const today = data.stats.today;
			const yesterday = data.stats.yesterday;
			const progressBar = document.getElementById('progress-bar');
			const diffText = document.getElementById('diff-text');

			let percent = 100;
			if (yesterday > 0) {
				percent = (today / yesterday) * 100;
			}
			percent = Math.min(percent, 200);

			progressBar.classList.remove(...Array.from(progressBar.classList).filter(c => c.startsWith('w-') || c.startsWith('w-[')));
			progressBar.classList.add(`w-[${percent}%]`);

			const diff = today - yesterday;
			const sign = diff >= 0 ? '+' : '-';
			const diffAbs = Math.abs(diff);
			const diffPercent = (diff / (yesterday || 1)) * 100;

			diffText.innerText = `${sign}${diffAbs} заявок (${diffPercent.toFixed(1)}%) по сравнению со вчерашним днем`;
			diffText.classList.replace('text-yellow-600', diff > 0 ? 'text-green-600' : 'text-red-600');
			progressBar.classList.add(diff >= 0 ? 'bg-green-600' : 'bg-red-600');
		})
		.catch(() => {
			document.getElementById('diff-text').innerText = "Ошибка загрузки данных";
			document.getElementById('diff-text').classList.replace('text-yellow-600', 'text-red-600');
		});
});