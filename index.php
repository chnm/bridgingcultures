<?php head(array('bodyid'=>'home')); ?>	


    <div class="intro four columns">
    
        <h1>Explore the Muslim Journeys Bookshelf</h1>
        
        <p>Welcome to the "Muslim Journeys" website, offering resources for exploring new and diverse perspectives on the people, places, histories, beliefs, and cultures of Muslims around the world, including those within the United States.  Start your journey by choosing a theme or a book. </p>
    
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
                if(($fullsizeHtml = item_thumbnail())) {
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

    <div class="twitter four columns alpha">
    
        <h3>Latest About #MuslimJourneys</h3>
        
        <p><a href="#" class="twitter-name">@dancohen</a><br>
        Lorem Ipsum is dummy text used in printing and has been standard for ages since an unknown printer scrambled type to make a specimen book <a href="#">#muslimjourneys</a> <a href="#"><span class="date">25 Jan 11</span></a></p>
        
        <p><a href="http://www.twitter.com/hashtag/MuslimJourneys" class="button">See more on Twitter</a></p>    
        
    </div>
    
    <div class="featured eight columns">
    
        <h2>Featured</h2>
        
        <?php 
        
        $featured = random_featured_item(); 
        set_current_item($featured);
        if(item_thumbnail()) {
            echo item_thumbnail();
        }
        echo '<h3>'.item('Dublin Core', 'Title') . '</h3>';
        echo item('Dublin Core', 'Description');
        ?>
        
    </div>
    
    <div class="toolkit four columns omega">
    
        <h3>Conversation Toolkit</h3>
        
        <p>Tools and tips for organizing, publicizing, and hosting informative and respectful discussions in your community using the "Muslim Journeys" books, films, and art resources. </p>
</p>

        <p><a href="#" class="button">Learn about the toolkit</a></p>    

    
    </div>    

</div>

<?php foot(); ?>