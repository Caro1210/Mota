<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php wp_head(); ?>
    </head>

    <body>

    <header>
        <nav> 
            <div class="logo_site">
            <a href="<?php echo get_site_url()?>">
                <img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="logo site Nathalie Mota">
            </a>
            </div>
        
        <?php
        wp_nav_menu([
            'theme_location' => 'header-main-menu',
        ]);
        ?>
       
        </nav>
    </header>