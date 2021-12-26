let cartProducts = [];
let cart = []
setCartProducts()

function setCartProducts() {
    if (getSession('cartProducts'))
        cartProducts = getSession('cartProducts')
    else setSession('cartProducts',cartProducts)
    if(getSession('cart'))
        cart = getSession('cart')
    else setSession('cart',cart)
}
function displayCartItems() {
    let items = [];
    if (getSession('cart').length > 0) {
        items = getSession('cart')
        const res  = postData('/cart-items',items)
        res.then(data => {
            let subtotal = 0
            const cartItems = data.map(item => {
                let img = ''
                if((item.img.startsWith('public')))
                    img = (item.img).slice(7)
                else img = item.img
                subtotal+=item.quantity*item.price
                return `
                    <tr>
                        <td>
                            <img src="${img}" alt="${item.item_title}" width="50" height="50" /> <br /> 
                            ${item.item_title} 
                            <i id="removeFromCart" data-id="${item.id}" data-title="${item.item_title}" class="fas fa-trash-alt ms-2 text-error"></i>
                        </td>
                        <td> ${item.price}</td>
                        <td><div class="flex-row-even"><ion-icon id="reduceCart" data-id="${item.id}" data-title="${item.item_title}" name="remove-circle-outline" size="large"></ion-icon><span>${item.quantity}</span><ion-icon id="addToCart" data-id="${item.id}" data-title="${item.item_title}" name="add-circle-sharp" size="large"></ion-icon></div></td>
                        <td>${item.quantity*item.price} </td>
                    </tr>`
            })

            if(cartItemsContainer) {
                cartItemsContainer.innerHTML = cartItems.join("")
                document.getElementById('subtotal').innerText = numberWithCommas(subtotal)
                document.getElementById('vat').innerText = numberWithCommas(parseInt(subtotal * 0.16))
                document.getElementById('total').innerText = numberWithCommas(parseInt(subtotal + subtotal * 0.16))
            }
        })
    }
    else {
        if (cartItemsContainer)
            cartItemsContainer.parentNode.parentNode.innerHTML = `<div class="flex-col-center"><h4>No Item in the cart.</h4><a href="/menu" class="nav--button">Browse Menu</a></div>`
    }

    fetchData('/menuitems')
        .then(menu => {
            displayMenuItems(menu);
            displayMenuButtons(menu);
        });
    countItems(getSession('cart'))
    displayOrderItems()

}

if (getSession('cart'))
    countItems(getSession('cart'))

function countItems(items) {
    let totalItems = 0
    items.forEach(item => {
        totalItems+=item.quantity
    })
    if(cartTotal)
        cartTotal.innerText = totalItems
}

function removeFromCart(id,title) {
    id = parseInt(id)
    let newItems = []
    let items = []
    if (getSession('cart'))
        items = getSession('cart')
    newItems =  items.filter(item => {
        if (item.id !== id) {
            return item;
        }
    })
    console.log(newItems)
    setSession('cart', newItems)
    setSession('success', `${title} removed from Cart`);
    showFeedBack()
    displayCartItems()
}

function addToCart(id,title) {
    const product = parseInt(id)
    const cartItem = {
        "id": product,
        "quantity": 1,
    }
    if (!getSession('cart')) {
        const cart = []
        cart.push(cartItem)
        setSession('cart', cart)
    } else {
        let cart = getSession('cart')
        if (!exists(product, cart)) {
            cart.push(cartItem)
            setSession('success', `${title} added to Cart`);
        } else {
            cart = updateCart(product, cart)
            setSession('success', `${title} Order Quantity Updated`);
        }
        setSession('cart',cart)
    }

    setCartProducts()

    if(!valueExists(product,cartProducts)) {
        cartProducts.push(product)
        setSession('cartProducts', cartProducts)
    }

    countItems(getSession('cart'))
    showFeedBack()
    displayCartItems()
}

function getCartQuantity(id,items) {
    let value = 0
    items.forEach(item => {
        if (item.id === id) {
            value = item.quantity
        }
    })
    return value
}



function reduceCart(id,title) {
    id = parseInt(id)
    const newItems = []
    let items = []
    if (getSession('cart'))
        items = getSession('cart')
    items.forEach(item => {
        if (item.id === id) {
            item.quantity--;
        }
        if(item.quantity > 0)
            newItems.push(item)
        else
            setSession('success', `${title} removed from cart`);
    })
    setSession('cart', newItems)
    if(exists(id,newItems)) {
        setSession('success', `${title} Order quantity reduced by 1`);
    }
    else {
        const newArray = removeFromArray(id,getSession('cartProducts'))
        setSession('cartProducts',newArray);
    }
    showFeedBack()
    displayCartItems()
}

function updateCart(id,items) {
    const newItems = []
    items.forEach(item => {
        if (item.id === id) {
            item.quantity++;
        }
        newItems.push(item)
    })
    return newItems
}