const sidebar = document.getElementById("sidebar");
const content = document.getElementById("main-content");

const toggle = document.getElementById("sidebarToggleTop");
const modalClose = document.getElementById("closeModal");
const modalWrapper = document.getElementById('modalWrapper');
const deleteButtons = document.querySelectorAll('.delete-btn')
const dishId = document.getElementById('dishId')
const dishTitle = document.getElementById('dishTitle')
const deleteDish = document.getElementById('deleteDish')

deleteDish.addEventListener('click',async function (){
  const url = "/admin_dishes_delete"
  const id = dishId.textContent
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
    body: JSON.stringify(id) // body data type must match "Content-Type" header
  });
  console.log(response.json())
  return response.json();
})

deleteButtons.forEach(function (btn) {
  btn.addEventListener("click", function (e) {
    const id = e.currentTarget.dataset.id;
    const title=  e.currentTarget.dataset.title;
    modalWrapper.style.display = "flex"
    dishId.textContent = id;
    dishTitle.textContent = title
  });
});

modalClose.addEventListener('click',function (e){
  modalWrapper.style.display = "none"
})

window.addEventListener('DOMContentLoaded',function (){
  setIcon()
})

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
// document.getElementById('close').addEventListener('click',(e) =>closeAlert(e.target))
// function closeAlert(icon) {
//   icon.parentNode.parentNode.textContent = '';
// }
