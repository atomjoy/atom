// Scope global example
const a = 'Jon'
first()

// Scope 1
function first() {
	const b = 'Hello!'
	const age = 21
	second()

	if (age > 18) {
		const e = 'Ha!'
		var f = true
	}

	// Scope 2
	function second() {
		const c = 'Hi!'
		console.log('First', c + b + a + f + e) // e - let, const niedostępne block scope, var function scope
		third()
	}
}

// Scope 2
function third() {
	const d = 'Hey!'
	console.log('Second', d + a + f + e + c + b) // ReferenceError (f,e,c,b) różne scopy
}
