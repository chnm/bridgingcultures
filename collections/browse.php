<?php head(array('title'=>'Browse Themes','bodyid'=>'themes','bodyclass' => 'browse')); ?>

<h1>Browse Themes</h1>


<div class="twelve columns offset-by-two alpha row">

<?php
set_items_for_loop(get_items(array('type' => 'Theme Icon'),6));
?>

    <?php if(has_items_for_loop()): ?>
     
       <!-- Loop for items -->
        <?php while(loop_items()): ?>
                        
        <div class="row">
                        
            <?php            
            
            $currentCollection = multicollections_get_collections_for_item();
            set_current_collection($currentCollection[0]);
            
            if(($fullsizeHtml = item_fullsize())) {
                
                echo '<div class="three columns alpha">';
                echo '<div class="theme-icon">';
                echo '<a href="collections/show/'.collection('id').'">'.$fullsizeHtml.'</a>'; 
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p>Theme icon missing.</p>';
            }
            ?>            

            <div class="nine columns omega">
            
                <h3><a href="collections/show/<?php echo collection('id'); ?>"><?php echo collection('name'); ?></a></h3>
                
                <div class="theme-decription">
                    <?php echo nls2p(collection('Description', array('snippet'=>150))); ?>
                </div>
            
            </div>
            
        </div>

            
        <?php endwhile; ?>

     
    <?php else: ?>
     
        <!-- Message if there are no items -->
        <p>Where are your themes?</p>
    <?php endif; ?>

</div>





<?php foot(); ?>