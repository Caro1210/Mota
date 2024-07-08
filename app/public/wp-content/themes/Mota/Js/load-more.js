jQuery(document).ready(function($) {
    $('#btnLoad-more').on('click', function() {
        var button = $(this);
        var page = button.data('page');
        var ajaxUrl = button.data('url');

        var data = {
            'action': 'load_more_photos',
            'page': page,
            'nonce': load_more_params.nonce
        };

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#photo-container').append(response.data);
                    button.data('page', page + 1);
                } else {
                    button.text('Aucune photo supplémentaire');
                    button.prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
