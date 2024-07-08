<?php 
    get_template_part("templates_parts/contact");
    get_template_part("templates_parts/lightbox");
?>

<footer>
    <nav>     
        <?php
        wp_nav_menu([
            'theme_location' => 'footer-second-menu',
        ]);
        ?>
    </nav>
</footer>