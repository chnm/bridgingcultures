<?php 

$bodyclass = 'page simple-page';
if (simple_pages_is_home_page(get_current_simple_page())) {
    $bodyclass .= ' simple-page-home';
} ?>

<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => 'simple-page')); ?>

<nav id="page-menu" class="five columns alpha">
    
    <h3>About Muslim Journeys</h3>
    
    <?php echo simple_pages_navigation(1); ?>
    
</nav>

<div id="right-content" class="eleven columns omega">

    <h1><?php echo html_escape(simple_page('title')); ?></h1>
    <?php echo eval('?>' . simple_page('text')); ?>    

</div>
