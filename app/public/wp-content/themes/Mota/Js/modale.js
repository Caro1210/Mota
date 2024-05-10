//test
console.log("Modale OK");

jQuery(document).ready(function ($) {
    // Ouvre la modale au clic sur l'élément de menu
    $('#menu-item-44').click(function () {
      $('#contact_modale').show(); // Affiche la modale
    });
  
    // Ferme la modale si l'utilisateur clique sur l'overlay
    $('.modale_contact').click(function(event) {
      if (event.target === this) {
        $(this).hide(); // Cache la modale
      }
    });
});