<?php head(array('bodyid'=>'home')); ?>	


    <div class="intro four columns">
    
        <h1>Explore the Muslim Journeys Bookshelf</h1>
        
        <p>Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
    
    </div>
    
    <div class="theme-icons twelve columns">
    
    <?php
        set_items_for_loop(get_items(array('type' => 'Theme Icon'),6));
        ?>
        <?php if(has_items_for_loop()): ?>
         
           <!-- Loop for items -->
            <?php 
            $i = 0;
            while(loop_items()):
                $i++;
                if($i%3 === 0) {
                    echo '<div class="four columns omega">';
                } elseif ($i === 1 || $i === 4) {
                    echo '<div class="four columns alpha">';
                } else {
                    echo '<div class="four columns">';
                    }  
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


<div class="books carousel">

<?php
    set_items_for_loop(get_items(array('type' => 'Book'),30));
    ?>
    <?php if(has_items_for_loop()): ?>
        <ul>
       <!-- Loop for items -->
        <?php while(loop_items()): ?>
            <?php                                   
                echo '<li>' . link_to_item(item_fullsize(array('class' => 'book-cover', 'alt' => strip_tags(item('Dublin Core', 'Title'))))) . '</li>';
            ?>            
        <?php endwhile; ?>
        </ul>
     
        <?php else: ?>         
            <!-- Message if there are no items -->
            <p>Books missing.</p>
        <?php endif; ?>
		
</div>

</div>

<?php foot(); ?>