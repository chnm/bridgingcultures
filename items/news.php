<nav id="page-menu" class="five columns alpha">
    
    <?php simple_pages_set_current_page(get_db()->getTable('SimplePagesPage')->find(1)); ?>
    
    <h3><a href="<?php echo uri('about'); ?>"><?php echo simple_page('title'); ?></a></h3>

    <?php simple_pages_set_current_page(get_db()->getTable('SimplePagesPage')->find(5)); ?>

    <?php echo simple_pages_navigation(simple_page('parent_id'),0); ?>
    
</nav>

<div id="right-content" class="eleven columns omega">    

    <h1><?php echo html_escape(simple_page('title')); ?></h1>    
    <h2><?php echo link_to_item(item('Item Type Metadata', 'Title')); ?></h2>
    <p class="byline">By <?php echo html_escape(item('Item Type Metadata', 'Author')); ?> on <?php echo html_escape(item('date added')); ?></p>
    <?php         
    if (item_thumbnail()) {
            echo item_thumbnail();
    }
    ?>
    <div class="post-content">
    <?php echo item('Item Type Metadata', 'Text'); ?>
    </div>
    <p class="archive-link"><a href="<?php echo uri('news-features-archive'); ?>">Click for News and Features Archives</a></p>
    
</div>