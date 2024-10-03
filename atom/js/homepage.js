function mouseMove(btn, e) {
	let rect = e.target.getBoundingClientRect()
	let x = e.clientX - rect.left
	let y = e.clientY - rect.top
	btn.style.setProperty('--x', x + 'px')
	btn.style.setProperty('--y', y + 'px')
}

window.onload = () => {
	console.log('Homepage loaded')

	document.querySelectorAll('.home-button').forEach((btn) => {
		btn.addEventListener('mousemove', (event) => {
			mouseMove(btn, event)
		})
	})
}
