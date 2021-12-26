function  removeFromArray(id,items) {
    let newArray = []
    items.forEach(item => {
        if (item !== id) {
            newArray.push(item)
        }
    })

    return newArray
}

function valueExists(key,items) {
    let value = false
    items.forEach(item => {
        if (item === key) {
            value =  true;
        }
    })
    return value
}

function exists(id,items) {
    let value = false
    items.forEach(item => {
        if (item.id === id) {
            value =  true;
        }
    })
    return value
}

async function fetchData(url = '') {
    const response = await fetch(url)
    return response.json()
}

async function postData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}