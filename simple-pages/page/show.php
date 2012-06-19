<?php 
$simpleslug = get_current_simple_page()->slug;
$bodyclass = 'page simple-page ' . $simpleslug;
if (simple_pages_is_home_page(get_current_simple_page())) {
    $bodyclass .= ' simple-page-home';
} ?>

<?php if( $simpleslug == 'resources'): ?>

<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => 'resources')); ?>


    <div class="intro ten columns offset-by-three">

        <h1><?php echo simple_page('title'); ?></h1>
        <p><?php echo eval('?>' . simple_page('text')); ?></p>
        
        <?php echo simple_search(); ?>
    
    </div>
    
    <div class="four columns alpha sidebar">
   
        <div class="themes">
        
                <?php
                    set_items_for_loop(get_items(array('type' => 'Theme Icon'),6));
                    ?>
                <?php if(has_items_for_loop()): ?>
                 
                   <!-- Loop for items -->
                    <?php 
                    while(loop_items()):
                        $multiCollections = multicollections_get_collections_for_item();
                        if(($fullsizeHtml = item_thumbnail())) {
                            echo '<div class="theme-icon">' . $fullsizeHtml . '</div>'; 
                        }
                        ?>            
                    <?php endwhile; ?>
                 
                    <?php else: ?>         
                        <p>Theme icon missing.</p>
                <?php endif; ?>
                
                <h3><a href="collections">Review Themes and Essays to Guide Your Journey</a></h3>
                
                <p>Are you entering territory unfamiliar to you?  Look here for thematic  essays prepared by learned and experienced guides, who can escort you on the journey of your choice. </p>
                
        </div>
   
        <div class="toolkits">
        
            <h3><a href="#">Start Discussions With the Conversation Toolkit</a></h3>
            
            <p>Find tools and tips for organizing, publicizing, hosting, and facilitating informative and respectful discussions in your community using the "Muslim Journeys" books, films, and art resources.</p>
        
        </div>
   
   </div>
   
   <div class="item-types twelve columns omega">

    <?php 
        $allItemTypes = get_item_types();
        $itemTypes = array();
        foreach($allItemTypes as $itemType) {
            $itemsTotal = $itemType->totalItems();
            if($itemsTotal > 0 && $itemType->name != 'Theme Icon') {
                array_push($itemTypes,$itemType);
            }
        }
        
        if($itemTypes > 0): 
        set_item_types_for_loop($itemTypes);
            while(loop_item_types()):
                $currentItemType = get_current_item_type();
                echo '<div class="item-type">'. link_to_items_with_item_type($currentItemType->name) . '</div>';
            endwhile;
        endif; ?>   
   
   </div>

<?php else: ?>

<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => 'simple-page')); ?>

<nav id="page-menu" class="five columns alpha">
    
    <h3>About Muslim Journeys</h3>
    
    <?php echo simple_pages_navigation(1); ?>
    
</nav>

<div id="right-content" class="eleven columns omega">

    <h1><?php echo html_escape(simple_page('title')); ?></h1>
    <?php echo eval('?>' . simple_page('text')); ?>    

</div>

<?php endif; ?>