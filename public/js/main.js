import setSession, {getSession,removeSession,clearSession} from './modules/session'


const sidebar = document.getElementById("sidebar");
const content = document.getElementById("main-content");
const file_input = document.querySelectorAll('input[type="file"]');
const accountToggle = document.querySelector('#accountToggle')
const dropdownContent = document.querySelector('.dropdown-content')


const toggle = document.getElementById("sidebarToggleTop");
const modalClose = document.querySelectorAll(".closeModal");
const modalWrapper = document.querySelectorAll('.modal-wrapper');
const id = document.querySelector('.id');
const title = document.querySelector('.title');
const actionButtons = document.querySelectorAll('.action-btn')
const deleteDish = document.getElementById('deleteDish') ?? false
const fetchDish = document.getElementById('fetchDish') ?? false

const closeFeedback = document.querySelectorAll('.close-icon');
const feedback = document.querySelectorAll('.feedback');

const linkButtons = document.querySelectorAll(".btn-link")
const commentForm = document.getElementById('commentForm');
const reservationForm = document.getElementById('reservationForm')

const cartTotal = document.getElementById('cartTotal')
const cartItemsContainer = document.getElementById('cartItems')
const sectionCenter = document.querySelector(".menu-items");
const btnContainer = document.querySelector(".btn-container");
const orderForm = document.getElementById('orderForm')

let cartProducts = [];
let cart = []
setCartProducts()
console.log(getSession('user'))

function setCartProducts() {
  if (getSession('cartProducts'))
    cartProducts = getSession('cartProducts')
  else setSession('cartProducts',cartProducts)
  if(getSession('cart'))
    cart = getSession('cart')
  else setSession('cart',cart)
}



function displayOrderItems()
{
  let items = [];
  let orderItemsContainer = document.getElementById('orderItemsContainer')
  if (getSession('cart').length > 0) {
    items = getSession('cart')
    const res  = postData('/cart-items',items)
    res.then(data => {
      let subtotal = 0
      const orderItems = data.map(item => {
        let img = ''
        if((item.img.startsWith('public')))
          img = (item.img).slice(7)
        else img = item.img
        subtotal+=item.quantity*item.price
        return `
                    <div class="row">
                        <div class="col-6">
                            <img src="${img}" alt="${item.item_title}" height="100" width="100"/>
                        </div>
                        <div class="col-6">
                            <p>${item.item_title}</p>
                            <p class="text-warning">Ksh ${item.price}</p>
                            <p>qty: ${item.quantity}</p>

                        </div>
                    </div>
                    <div class="underline-thin"></div>`
      })

      if(orderItemsContainer) {
        orderItemsContainer.innerHTML = orderItems.join("")
        document.getElementById('total').innerText = numberWithCommas(parseInt(subtotal + subtotal * 0.16))
        document.getElementById('amount').value = parseInt(subtotal + subtotal * 0.16)
      }
    })
  }
  else {
    let ordersPage = document.querySelector('.orders')
    if (ordersPage)
      ordersPage.innerHTML = `<div class="flex-col-center"><h4>No Item in the cart.</h4><a href="/menu" class="nav--button">Browse Menu</a></div>`
  }
}


if(orderForm)
orderForm.addEventListener('submit',e => {
  e.preventDefault()
  const orderFormData = new FormData(e.currentTarget)
  const data = {}
  for (let [key,value] of orderFormData.entries()) {
    data[key] = value
    if(key === 'payment_method') continue
    if(document.getElementById(key).classList.contains('is-invalid')) {
      document.getElementById(key).classList.remove('is-invalid')
      document.getElementById(key).nextElementSibling.innerHTML = ''
    }
  }
  data['order_items'] = getSession('cart')
  console.log(data)
  const response = postData('/checkout',data)
  response.then(dat => {
    console.log(dat)
    if(dat === true) {
      removeSession('cart')
      setSession('success','Order placed. proceed to payment ')
      location.replace('/payment')
    }
  else {
      if(typeof dat === "object") {
        for (const [key, value] of Object.entries(dat)) {
          document.getElementById(key).classList.add('is-invalid')
          document.getElementById(key).nextElementSibling.innerHTML = value[0]
          console.log(`${key}: ${value}`);
        }
      }
      else {
        setSession('error',dat)
        showFeedBack()
      }
    }
  })
})

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

function exists(id,items) {
  let value = false
  items.forEach(item => {
    if (item.id === id) {
      value =  true;
    }
  })
  return value
}

if(reservationForm)
  reservationForm.addEventListener('submit',e => {
    e.preventDefault()
    const reservationFormData = new FormData(e.currentTarget)
    const data = {}
    for (let [key,value] of reservationFormData.entries()) {
      data[key] = value;
    }

    if(data.reserved_by && data.date && data.time && data.adults) {
      console.log(data)
      postData('/reserve',data)
          .then(data => {
            console.log(data)
            if(data === true) {
              setSession('success', 'Reservation Successful. See you later');
              window.location.replace('/');
            }
            else {
              setSession('error', 'Sorry,an error. Try again');
            }
          })

    }
  })

function loadComments(id) {
  const commentsContainer = document.getElementById('comments')
  let last_id
  if(commentsContainer) {
    fetchData(`/item_comments?id=${id}`)
        .then(data => {
          if (!data) {
            commentsContainer.innerHTML = ''
          } else {
            const comments = data.map(comment => {
              id = comment.id
              return `<li id="comment-${comment.id}">
             <div class="box">
              <p>${comment.comment}</p>
              <p>--${comment.author_name} ${comment.date}</p>
              </div>
              <p><button><i class="far fa-thumbs-up"></i> <span>0</span></button>
              <button><i id="deleteComment" data-id="${id}" class="fas fa-trash-alt ms-2 text-error"></i></button></p>
            </li>`
            })
            commentsContainer.innerHTML = comments.join('')
          }
        })

    console.log(last_id)
    var element = document.getElementById(`comment-${last_id}`);

    element.scrollIntoView();
    element.scrollIntoView(false);
    element.scrollIntoView({block: "end"});
    element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});

  }
}

if(commentForm)
commentForm.addEventListener('submit',(e) => {
  e.preventDefault();
  const commentFormData = new FormData(e.currentTarget);
  const data = {}
  for (let [key,value] of commentFormData.entries()) {
    data[key] = value;
  }

  let menuId = data.menu

  if(data.menu && data.comment) {
    postData('/comment', data)
        .then(data => {
          console.log(data); // JSON data parsed by `data.json()` call
          if(data === true) {
            setSession('success', 'Comment posted');
          }
          else {
            setSession('error', 'You must be logged in to comment.');
          }
          loadComments(menuId);
        });
  }

})


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

linkButtons.forEach(linkButton =>  {
  linkButton.addEventListener('click', (e)=>{
    const url = e.currentTarget.dataset.target
    window.location.replace(url)
  })
})

closeFeedback.forEach(btn => {
  btn.addEventListener('click', function () {
    feedbackClose();
  })
})

if(fetchDish)
  fetchDish.addEventListener('click',async function() {
    const Id = id.textContent
    const url = `/admin_fetch_dish?id=${Id}`
    const response = await fetch(url)
    response.json().then(result => {
      console.log(result)
      if (result) {
        document.item_title.value = result['title'];
      }
    })

  } )

if(deleteDish) {
  deleteDish.addEventListener('click', async function () {
    const Id = id.textContent
    const url = `/admin_dishes_delete?id=${Id}`
    const response = await fetch(url)
    response.json().then(result => {
      if (result === 'true') {
        console.log('Success');
        setSession('success','Item deleted Successfully')
      }
      else  {
        console.error('Unsuccessful')
        setSession('error',result)

      }
      window.location.replace("/admin_dishes");
    })
  })
}

actionButtons.forEach(function (btn) {
  btn.addEventListener("click", function (e) {
    const Id = e.currentTarget.dataset.id;
    const Title=  e.currentTarget.dataset.title;
    const modal = document.getElementById(e.currentTarget.dataset.target);
    modal.style.display = "flex"
    if(id)
    id.textContent = Id;
    if(title)
    title.textContent = Title
  });
});

function feedbackClose() {
  const feedback = document.querySelectorAll('.feedback');
  feedback.forEach(fb=>{
    fb.textContent = '';
  })
}

modalClose.forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    modalWrapper.forEach(function (md) {
      if (md.style.display === "flex") {
        md.style.display = "none"
      }
    })
  })
})

function showFeedBack() {
  if(getSession('success')) {
    feedback[0].innerHTML = `
              <div class="alert alert-success">
                <ion-icon name="checkmark-outline" size="large"></ion-icon>
                <span>${getSession('success')}</span>
                <span class="close-icon" id="close" onclick="feedbackClose()"><ion-icon name="close-sharp" size="large" id="close"></ion-icon></span>
            </div>
            `
    removeSession('success')
  }
  if(getSession('error')) {
    feedback[0].innerHTML = `
              <div class="alert alert-error">
                <ion-icon name="alert-circle-outline" size="large"></ion-icon>
                <span>${getSession('error')}</span>
                <span class="close-icon" id="close" onclick="feedbackClose()"><ion-icon name="close-sharp" size="large" id="close"></ion-icon></span>
            </div>
            `
    removeSession('error')
  }
  setTimeout(feedbackClose,5000)
}

if(toggle)
toggle.addEventListener('click',(e) => toggleMenu(e))

function toggleMenu(e) {
  if (sidebar.classList.contains("show")) {
    sidebar.classList.remove("show");
    e.currentTarget.innerHTML = '<i class="fas fa-bars"></i>';
  } else {
    sidebar.classList.add("show");
    e.currentTarget.innerHTML = '<ion-icon name="arrow-back-sharp" size="medium"></ion-icon>';
  }
}


function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function displayMenuItems(menuItems) {
  let displayMenu = menuItems.map(function (item) {
    let img = ''
    let icon = ''
    const qty = getCartQuantity(parseInt(item.id),getSession('cart')) ?? 0
    if((item.img.startsWith('public')))
      img = (item.img).slice(7)
    else img = item.img
    if(qty>0)
      icon = `<ion-icon name="checkmark-outline" size="large"></ion-icon>`
    else
      icon = `<ion-icon id="addToCart" data-title="${item.item_title}" data-id="${item.id}" name="cart-outline" size="large"></ion-icon>`
    return ` <div class="menu-item">
    <div class="item-img">
    <a href="/menuitem?id=${item.id}"><img class="menu-img" src="${img}" alt="${item.item_title}" /></a>
    </div>
    
    <div class="item-description">
      <div class="item-header">
        <h4>${item.item_title}</h4>
        <i class="far fa-star ms-2"></i>
      </div>
      <div class="item-footer">
          <h3>KES ${numberWithCommas(item.price)}</h3>
          ${icon}
      </div>
    </div>
    </div>
    `;
  });
  displayMenu = displayMenu.join("");
  if (!sectionCenter) return;
  sectionCenter.innerHTML = displayMenu

}

function displayMenuButtons(menu) {
  const categories = menu.reduce(
      function (values, item) {
        if (!values.includes(item.item_category)) {
          values.push(item.item_category);
        }
        return values;
      },
      ["all"]
  );

  if (!btnContainer) return;
  btnContainer.innerHTML = categories
      .map(function (category) {
        return `<button type="button" class="filter-btn" data-id=${category}>
          ${category}
        </button>`;
      })
      .join("");

  const filterBtns = btnContainer.querySelectorAll(".filter-btn");

  filterBtns.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      // console.log(e.currentTarget.dataset);
      const category = e.currentTarget.dataset.id;
      activeButton(category,filterBtns)
      const menuCategory = menu.filter(function (menuItem) {
        // console.log(menuItem.category);
        if (menuItem.item_category === category) {
          return menuItem;
        }
      });
      if (category === "all") {
        displayMenuItems(menu);
      } else {
        displayMenuItems(menuCategory);
      }
    });
  });
}

function activeButton(id,filterButtons) {
  filterButtons.forEach(function (btn) {
    if(btn.dataset.id === id) {
      btn.classList.add('selected')
    }
    else {
      if(btn.classList.contains('selected')) {
        btn.classList.remove('selected')
      }
    }
  })

}


window.addEventListener('DOMContentLoaded',function (){

  const menuitem_id = document.getElementById('menuitem_id')
  if(menuitem_id){
    loadComments(parseInt(menuitem_id.value))
  }
  fetchData('/menuitems')
      .then(menu => {
        displayMenuItems(menu);
        displayMenuButtons(menu);
      });

  if (file_input) {
    file_input.forEach(file => {
      file.classList.add('file-input')
    })

  }
  showFeedBack();
  displayCartItems()
})

document.addEventListener('click',(e) => {
  if(e.target.id === 'addToCart') {
    let id = e.target.dataset.id
    let title = e.target.dataset.title
    addToCart(id,title)
  }
  if(e.target.id === 'removeFromCart') {
    let id = e.target.dataset.id
    let title = e.target.dataset.title
    removeFromCart(id,title)
  }

  if(e.target.id === 'reduceCart') {
    let id = e.target.dataset.id
    let title = e.target.dataset.title
    reduceCart(id,title)
  }
})