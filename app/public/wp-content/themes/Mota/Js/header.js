//test
console.log("C'est l'heure du burger ^^");

jQuery(document).ready(function ($) {
    $('.hamburger').click(function () {
      $(this).toggleClass('open');
      $('header .nav_mobile').toggle(); 
    });
});
