console.log("Modale 2 OK");

jQuery(document).ready(function ($) {
    // Open modale from the button in single-photo
    $('#openModalButton').click(function (event) {
        event.preventDefault(); 
        var reference = $(this).data('ref-photo');
        $('input[name="reference"]').val(reference);
        $('#contact_modale.single-photo').css('display', 'flex'); 
        $('#overlay.single-photo').css('display', 'block');
    });
     
    // close modale 
    $(document).mousedown(function(event) {
        if (!$(event.target).closest('#contact_modale.single-photo').length) {
            $('#contact_modale.single-photo').css('display', 'none');
            $('#overlay.single-photo').css('display', 'none'); 
        }
    });
});
