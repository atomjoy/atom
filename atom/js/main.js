console.log('main.js')

async function subscribeUser(event, nounce = 'hash12345') {
    event.preventDefault()
    const el = document.querySelector('#subscribe-email')
    const email = el.value ?? false
    const url = '/wp-json/wow/v1/subscribe?email=' + email + '&nounce=' + nounce
    if (email && email.includes('@')) {
        try {
            const res = await fetch(url);
            if (!res.ok) {
                throw new Error('Response status: ' + res.status);
            }        
            const json = await res.json();
            console.log(json);
            alert('Subscribed to the newsletter. Confirm email address.')
        } catch (err) {
            const json = await res.json();
            console.log(json);
            console.log(err.message);
            alert('Not subscribed! Something went wrong.')
        }
    } else {
        alert('Insert email.')
    }

    return false;
}