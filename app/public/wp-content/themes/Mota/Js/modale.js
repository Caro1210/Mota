//test
console.log("Modale OK");

jQuery(document).ready(function ($) {
  // Open modale
  $('.menu-item-44').click(function (event) {
    event.preventDefault(); 
    $('#contact_modale').css('display', 'flex'); 
    $('#overlay').css('display', 'block');
    $('header .nav_mobile').css('display', "none");
    $('.hamburger').removeClass('open');
  });

  // close modale 
  $(document).mousedown(function(event) {
    if (!$(event.target).closest('#contact_modale').length) {
      $('#contact_modale').css('display', 'none');
      $('#overlay').css('display', 'none'); 
    }
  });
});
