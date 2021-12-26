// Menu js code

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
          <h3>KES ${item.price}</h3>
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

