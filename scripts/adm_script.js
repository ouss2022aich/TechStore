let sidebar_btn = document.getElementById('sidebar_btn');
let target_sidebar = sidebar_btn.getAttribute('data-target');
let adm_sidebar = document.getElementById(target_sidebar);


sidebar_btn.addEventListener( 'click' , (e) => {
    adm_sidebar.classList.toggle('sidebar_visible');
    
})


