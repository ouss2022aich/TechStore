
let menu_bar  = document.getElementById('menu_bar');
let menu_bar_target = document.getElementById('menu_bar_target');

menu_bar.addEventListener('click' , (e) => {

   menu_bar_target.classList.toggle('menu_active');  
   menu_bar.classList.toggle('menu_bar_active'); 
})