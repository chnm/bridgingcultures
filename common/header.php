<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <title>Bridging Cultures Bookshelf: Muslim Journeys</title>
    <link rel="shortcut icon" href="<?php echo public_uri('themes/muslimjourneys/images/favicon.ico'); ?>">
<!-- Stylesheets -->
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,700,700italic|Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <?php
    queue_css(array('style','skeleton','layout', 'orangebox'), 'screen');
    queue_css('ie', 'all', '(gte IE 6)');
    queue_js(array('modernizr.custom.71332', 'jquery.cookie', 'jquery.hoverIntent.minified', 'selectivizr-min'));
    ?>    

<!-- Javascript -->
    <?php  
    plugin_header();
    display_css();
    display_js(); 
    ?>

    <script type="text/javascript">
        oB.settings.addThis = false;
    </script>    
    
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>


<?php plugin_body(); ?>

    <header>
    
        <div class="container">
    
            <div class="logo"><?php echo link_to_home_page(); ?></div>
            
            <nav>
                
                <ul>
                    <?php echo public_nav_main(array(
                        'Bookshelf' => uri('bookshelf'), 
                        'Themes'=>uri('themes'),
                        'Resources'=>uri('resources'),
                        'About'=>uri('about')
                    )); ?>
                </ul>
                
            </nav>
            
            <?php echo bc_simple_search(); ?>
        
        </div>
    
    </header>

    <div class="wrap">
    
        <div id="content" class="container container-sixteen">
