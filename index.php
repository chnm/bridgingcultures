<?php head(array('bodyid'=>'home')); ?>	

<div class="intro four columns alpha">

    <h1>Explore the Muslim Journeys Bookshelf</h1>
    
    <p>Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>

</div>

<div class="home-collections">

<?php
    set_items_for_loop(get_items(array('type' => 'Theme Icon'),6));
    ?>
    <?php if(has_items_for_loop()): ?>
     
       <!-- Loop for items -->
        <?php while(loop_items()): ?>            
            <div class="four columns">
            <?php                                   
                $multiCollections = multicollections_get_collections_for_item();
                if(($fullsizeHtml = item_fullsize())) {
                    echo '<a href="collections/show/' . $multiCollections[0]->id . '">' . $fullsizeHtml . '<span>' . $multiCollections[0]->name . '</span></a>'; 
                }
            ?>            
            </div>
        <?php endwhile; ?>
     
        <?php else: ?>         
            <!-- Message if there are no items -->
            <p>Theme icon missing.</p>
        <?php endif; ?>
		
</div>

<?php foot(); ?>