<div class="lightbox" id="lightbox-container" style="display:none;">
    <div id="overlay3"></div>
    <button class="close-btn" id="close-lightbox" type="button">
        <img src="<?php echo get_template_directory_uri(); ?>/images/white_cross.png" alt="fermeture lightbox">
    </button>

    <div class="column">

        <div class="lightbox__nav">

            <div class="arrow-left" id="prev-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/precedente_left.png" alt="Précédente">
            </div>

            <div class="lightbox_img" id="lightbox-image">
                <img src="" alt="Lightbox Image">

            </div>
            <div class="arrow-right" id="next-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/suivante_right.png" alt="Suivante">
            </div>
        </div>
        <div class="lightbox__text">
            <p id="lightbox-reference"></p>
            <p id="lightbox-title"></p>
        </div>
    </div>
</div>
