let wholePage = document.getElementById('page_wrapper');
let btn = document.getElementById('nav_collapse_btn');


btn.addEventListener('click', collapse);

function collapse() {
  wholePage.classList.toggle('collapsed');
  if(wholePage.classList.contains('collapsed')){
    btn.innerHTML = "<i class='bx bxs-chevrons-right'></i>"; 
  } else {
    btn.innerHTML = "<i class='bx bxs-chevrons-left'></i>"; 
  } 
}
