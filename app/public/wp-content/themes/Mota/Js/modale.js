//test
console.log("Modale OK");

jQuery(document).ready(function ($) {
  // Open modale
  $('#menu-item-44').click(function (event) {
    event.preventDefault(); 
    $('#contact_modale').css('display', 'flex'); 
  });

  // close modale if cliqued on send
  $('.modale_contact').click(function(event) {
    if (event.target === this) {
      $(this).css('display', 'none'); 
    }
  });
});



