jQuery(document).ready(function($) {
    // Custom select styling and behavior
    $('select.custom-select').each(function() {
        var $this = $(this);
        var $wrapper = $('<div class="custom-select-wrapper"></div>');
        var $display = $('<div class="custom-select-display"></div>').text($this.find('option:selected').text());

        $this.before($wrapper).css('visibility', 'visible').hide();
        $wrapper.append($display);

        var $list = $('<div class="custom-select-options"></div>').hide();
        $this.find('option').each(function() {
            var $optionValue = $(this).val();
            var $option = $('<div class="custom-select-option"></div>').text($(this).text());
            $option.attr('data-value', $optionValue);
            
            if ($optionValue !== 'all') {
                $option.addClass('lowercase-option');
            }

            $option.on('click', function() {
                $this.val($(this).data('value')).change();
                $display.text($(this).text());
                $list.hide();
            });

            $list.append($option);
        });

        $wrapper.append($list);
        $display.on('click', function() {
            $list.toggle();
        });

        $this.on('change', function() {
            $display.text($this.find('option:selected').text());
        });
    });

    // Event listener for filter change
    $('.custom-select').on('change', function() {
        var categorie = $('#select-categories').val();
        var format = $('#select-formats').val();
        var annee = $('#select-annee').val();
        var ajaxUrl = load_more_params.ajax_url;

        var data = {
            'action': 'filter_photos',
            'categorie': categorie,
            'format': format,
            'annee': annee,
            'nonce': load_more_params.nonce
        };

        console.log('Data being sent:', data);

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            success: function(response) {
                console.log('Response received:', response);
                if (response.success) {
                    $('#photo-container').html(response.data);
                } else {
                    $('#photo-container').html('<p>Aucune photo trouvée.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
            }
        });
    });
});


