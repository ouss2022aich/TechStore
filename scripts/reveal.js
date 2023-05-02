$( document ).ready(function() {
    revs = document.querySelectorAll('.reveal');
   
    for (let i = 0; i < revs.length ; i++) {
      var wh = window.innerHeight;
      var rt = revs[i].getBoundingClientRect().top;
   
      var rp =50;

      if ( rt < wh - rp ){
       
        revs[i].classList.add('revealed');
      }else{
        revs[i].classList.remove('revealed');
      }
          
    }
    window.addEventListener('scroll', () => {
    
      revs = document.querySelectorAll('.reveal');
   
    for (let i = 0; i < revs.length ; i++) {
      var wh = window.innerHeight;
      var rt = revs[i].getBoundingClientRect().top;
   
      var rp =50;

      if ( rt < wh - rp ){
       
        revs[i].classList.add('revealed');
      }else{
        revs[i].classList.remove('revealed');
      }
          
    }
    })

   


});