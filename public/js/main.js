const sidebar = document.getElementById("sidebar");
const content = document.getElementById("main-content");
const file_input = document.querySelectorAll('input[type="file"]');


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
          window.location.replace(`/menuitem?id=${menuId}`);

        });
  }

})

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

window.addEventListener('DOMContentLoaded',function () {
  if (file_input) {
    file_input.forEach(file => {
      file.classList.add('file-input')
    })
  }
})

linkButtons.forEach(linkButton =>  {
  linkButton.addEventListener('click', (e)=>{
    const url = e.currentTarget.dataset.target
    window.location.replace(url)
  })
})

closeFeedback.forEach(btn => {
  btn.addEventListener('click', function () {
    feedback.forEach(fb=>{
      fb.textContent = '';
    })
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
      if (result) {
        console.log('Success');
        window.location.replace("/admin_dishes");
      }
      else console.error('Unsuccessful')
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

modalClose.forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    modalWrapper.forEach(function (md) {
      if (md.style.display === "flex") {
        md.style.display = "none"
      }
    })
  })
})

window.addEventListener('DOMContentLoaded',function (){
  if (sidebar)
    setIcon()
})

if(toggle)
toggle.addEventListener('click',function (){
  setIcon()
  sidebarToggle()
})

function sidebarToggle() {
    if (sidebar.style.display === "none") {
    sidebar.style.display = "block";
    sidebar.style.zIndex = "99999";
  } else {
    sidebar.style.display = "none";
    content.style.width = "100%";
  }
}

function setIcon() {
  let close_icon = document.createElement("ion-icon");
  close_icon.setAttribute('name','arrow-back-sharp');
  close_icon.setAttribute('size','medium');
  let menu_icon = document.createElement('i');
  menu_icon.classList.add('fa');
  menu_icon.classList.add('fa-bars');

  if (sidebar.style.display === "none") {
    toggle.textContent = "";
    toggle.appendChild(close_icon);
  } else {
    toggle.textContent = "";
    toggle.appendChild(menu_icon);
  }
}
