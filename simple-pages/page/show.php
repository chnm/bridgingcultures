<?php 
$simpleslug = get_current_simple_page()->slug;
$bodyclass = 'page simple-page ' . $simpleslug;
if (simple_pages_is_home_page(get_current_simple_page())) {
    $bodyclass .= ' simple-page-home';
} ?>

<?php if( $simpleslug == 'resources'): ?>

    <?php include('resources.php'); ?>

<?php else: ?>

<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => 'simple-page')); ?>

<nav id="page-menu" class="five columns alpha">
    
    <?php $parentId = simple_page('parent_id'); ?>
    
    <?php if ($parentId == 0): ?>

        <h3><a href="<?php echo uri(simple_page('slug')); ?>"><?php echo simple_page('title'); ?></a></h3>
    
        <?php echo simple_pages_navigation(simple_page('id'),0); ?>
    
    <?php else: ?>

        <?php if ($simpleslug == 'news-features-archive') : ?>
        
            <?php $parentPage = get_db()->getTable('SimplePagesPage')->find(1); ?>
            <?php $parentId = 1; ?>
        
        <?php else: ?>
        
            <?php $parentPage = simple_pages_earliest_ancestor_page(simple_page('id')); ?>
            
        <?php endif; ?>

        <h3><a href="<?php echo uri(simple_page('slug', array(), $parentPage)); ?>"><?php echo simple_page('title', array(), $parentPage); ?></a></h3>

        <?php echo simple_pages_navigation($parentId,0); ?>
    
    <?php endif; ?>
    
</nav>

<div id="right-content" class="eleven columns omega">    

    <h1><?php echo html_escape(simple_page('title')); ?></h1>
    
    <?php if ($simpleslug == 'news' || $simpleslug == 'news-features-archive'): ?>

        <?php set_items_for_loop(get_items(array('type' => 'News/Feature Post', 'recent' => 'true'), ($simpleslug == 'news' ? 5 : 0))); ?>
        
        <?php if(has_items_for_loop()): ?>

            <?php while(loop_items()): ?>
                <?php $item = get_current_item(); ?>
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
            <?php endwhile; ?>
            
            <?php if ($simpleslug == 'news'): ?>
            <p class="archive-link"><a href="<?php echo uri('news-features-archive'); ?>">Click for News and Features Archives</a></p>
            <?php endif; ?>
         
        <?php endif; ?>
    
    <?php else: ?>
    <?php echo eval('?>' . simple_page('text')); ?>    
    <?php endif; ?>

</div>

<?php endif; ?>

<?php foot(); ?>
