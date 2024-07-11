jQuery(document).ready(function($) {
    const $lightboxContainer = $('#lightbox-container');
    const $lightboxImg = $('#lightbox-image img'); 
    const $lightboxTitle = $('#lightbox-title');
    const $lightboxReference = $('#lightbox-reference');
    const $closeLightbox = $('#close-lightbox');
    const $overlay = $('#overlay3');
    const $prevImage = $('#prev-image');
    const $nextImage = $('#next-image');
    console.log($lightboxImg[0].src);

    let images = [];
    let currentIndex = 0;

    function attachLightboxEvents() {
        images = [];
        $('.fullscreen-icon').each(function(index) {
            const imageUrl = $(this).data("full");
            console.log('Image URL:', imageUrl);
            const imageTitle = $(this).data('category');
            const imageReference = $(this).data('reference');

            images.push({ imageUrl, imageTitle, imageReference });

            $(this).off('click').on('click', function() {
                currentIndex = index;
                openLightbox(currentIndex);
            });
        });
    }

    function openLightbox(index) {
        if (index >= 0 && index < images.length) {
            const { imageUrl, imageTitle, imageReference } = images[index];
            console.log(images);

            $lightboxImg.attr('src', imageUrl);
            $lightboxTitle.text(imageTitle);
            $lightboxReference.text(imageReference);

            $lightboxContainer.css('display', 'flex');
            $overlay.css('display', 'block');
        } else {
            console.error('Index out of range: ', index);
        }
    }

    function closeLightboxFunc() {
        $lightboxContainer.css('display', 'none');
        $overlay.css('display', 'none');
    }

    function showPrevImage() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        openLightbox(currentIndex);
    }

    function showNextImage() {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        openLightbox(currentIndex);
    }

    $closeLightbox.on('click', closeLightboxFunc);
    $overlay.on('click', closeLightboxFunc);
    $prevImage.on('click', showPrevImage);
    $nextImage.on('click', showNextImage);

    attachLightboxEvents();

    $('#btnLoad-more').on('click', function() {
        const button = $(this);
        const page = button.data('page');
        const newPage = page + 1;
        const ajaxUrl = button.data('url');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                nonce: load_more_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('#photo-container').append(response.data);
                    button.data('page', newPage);
                    attachLightboxEvents();
                    button.show(); 
                } else {
                    button.text('Aucune photo supplémentaire');
                    button.prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur:', error);
                button.show();
            }
        });
    });

    // Make attachLightboxEvents globally accessible
    window.attachLightboxEvents = attachLightboxEvents;
});
