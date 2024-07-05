jQuery(document).ready(function($) {
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
            
            // Ajoutez une classe pour les options autres que "all"
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
});
