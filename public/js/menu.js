/* const menu = [
  {
    id: 1,
    title: "buttermilk pancakes",
    category: "breakfast",
    price: 1599,
    img: "./images/item-1.jpeg",
    desc: `I'm baby woke mlkshk wolf bitters live-edge blue bottle, hammock freegan copper mug whatever cold-pressed `,
  },
  {
    id: 2,
    title: "diner double",
    category: "lunch",
    price: 1399,
    img: "./images/item-2.jpeg",
    desc: `vaporware iPhone mumblecore selvage raw denim slow-carb leggings gochujang helvetica man braid jianbing. Marfa thundercats `,
  },
  {
    id: 3,
    title: "godzilla milkshake",
    category: "shakes",
    price: 699,
    img: "./images/item-3.jpeg",
    desc: `ombucha chillwave fanny pack 3 wolf moon street art photo booth before they sold out organic viral.`,
  },
  {
    id: 4,
    title: "country delight",
    category: "breakfast",
    price: 2099,
    img: "./images/item-4.jpeg",
    desc: `Shabby chic keffiyeh neutra snackwave pork belly shoreditch. Prism austin mlkshk truffaut, `,
  },
  {
    id: 5,
    title: "egg attack",
    category: "lunch",
    price: 2299,
    img: "./images/item-5.jpeg",
    desc: `franzen vegan pabst bicycle rights kickstarter pinterest meditation farm-to-table 90's pop-up `,
  },
  {
    id: 6,
    title: "oreo dream",
    category: "shakes",
    price: 1899,
    img: "./images/item-6.jpeg",
    desc: `Portland chicharrones ethical edison bulb, palo santo craft beer chia heirloom iPhone everyday`,
  },
  {
    id: 7,
    title: "bacon overflow",
    category: "breakfast",
    price: 899,
    img: "./images/item-7.jpeg",
    desc: `carry jianbing normcore freegan. Viral single-origin coffee live-edge, pork belly cloud bread iceland put a bird `,
  },
  {
    id: 8,
    title: "american classic",
    category: "lunch",
    price: 1299,
    img: "./images/item-8.jpeg",
    desc: `on it tumblr kickstarter thundercats migas everyday carry squid palo santo leggings. Food truck truffaut  `,
  },
  {
    id: 9,
    title: "quarantine buddy",
    category: "shakes",
    price: 1699,
    img: "./images/item-9.jpeg",
    desc: `skateboard fam synth authentic semiotics. Live-edge lyft af, edison bulb yuccie crucifix microdosing.`,
  },
];

*/


const sectionCenter = document.querySelector(".menu-items");
const btnContainer = document.querySelector(".btn-container");

// fetch api
window.addEventListener("DOMContentLoaded", async function () {
  await fetch('/menuitems')
      .then(response => response.json())
      .then(menu => {
        console.log(menu)
        displayMenuItems(menu);
        displayMenuButtons(menu);
      });
});

// window.addEventListener("DOMContentLoaded", function () {
//   displayMenuItems(menu);
//   displayMenuButtons(menu);
// })

function displayMenuItems(menuItems) {
  let displayMenu = menuItems.map(function (item) {
    return ` <div class="menu-item row">
    <div class="item-img">
    <a href="/menuitem?id=${item.id}"><img src="${item.img}" alt="${item.item_title}" /></a>
    </div>
    
    <div class="item-description">
    <div class="item-header">
    <h3>${item.item_title} &nbsp;</h3>
    <h3>KES ${item.price}</h3>
    </div>
    <p>
    ${item.desc}
    </p>
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
