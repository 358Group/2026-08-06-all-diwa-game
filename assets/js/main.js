(function(){
  var h=document.querySelector('.site-header');
  var t=document.querySelector('.menu-toggle');
  if(h&&t){t.addEventListener('click',function(){var o=h.classList.toggle('is-open');t.setAttribute('aria-expanded',o?'true':'false');});}
  document.querySelectorAll('a[href^="#"]').forEach(function(a){
    a.addEventListener('click',function(e){
      var id=a.getAttribute('href'); if(!id||id==='#')return;
      var el=document.querySelector(id); if(!el)return;
      e.preventDefault();
      var off=h?h.offsetHeight+8:8;
      window.scrollTo({top:el.getBoundingClientRect().top+window.scrollY-off,behavior:'smooth'});
    });
  });
})();