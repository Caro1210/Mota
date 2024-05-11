//test
console.log("Modale OK");

jQuery(document).ready(function ($) {
  // Open modale
  $('.menu-item-44').click(function (event) {
    event.preventDefault(); 
    $('#contact_modale').css('display', 'flex'); 
    $('header .nav_mobile').css('display', "none");
  });

  // close modale 
  $(document).mousedown(function(event) {
    if (!$(event.target).closest('#contact_modale').length) {
      $('#contact_modale').css('display', 'none');
    }
  });
});
