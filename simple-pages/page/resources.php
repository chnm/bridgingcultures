<?php head(array('title' => html_escape(simple_page('title')), 'bodyclass' => $bodyclass, 'bodyid' => 'resources')); ?>


<div class="intro ten columns offset-by-three">

    <h1><?php echo simple_page('title'); ?></h1>
    <p><?php echo eval('?>' . simple_page('text')); ?></p>
    
    <?php echo bc_simple_search(); ?>

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
            
            <h3><a href="collections">Review Themes and Essays to Guide Your Journey</h3></a>
            
            <p>Are you entering territory unfamiliar to you?  Look here for thematic  essays prepared by learned and experienced guides, who can escort you on the journey of your choice. </p>
            
    </div>

    <div class="toolkits">
    
        <h3><a href="<?php echo uri('toolkit'); ?>">Start Discussions With the Conversation Toolkit</a></h3>
        
        <p>Find tools and tips for organizing, publicizing, hosting, and facilitating informative and respectful discussions in your community using the "Muslim Journeys" books, films, and art resources.</p>
    
    </div>

</div>

<div class="item-types twelve columns omega">

    <div class="row">

        <div id="images" class="four columns alpha">
        
            <a href="<?php echo ('items/browse/type/still%20image'); ?>"><h3>Images</h3></a>
            
            <p>Historic and contemporary photographs, works of art (including calligraphy, illuminated books, artist tools, textiles, paintings, architecture, ceramics, gardens)</p>
        
        </div>

        <div id="texts" class="four columns">
        
            <a href="<?php echo ('items/browse/type/document'); ?>"><h3>Texts</h3></a>
            
            <p>Primary documents, book excerpts, journal articles, poems, travel narratives
</p>
        
        </div>

        <div id="audio-visual" class="four columns omega">
        
            <a href="<?php echo ('items/browse/type/audio-visual%20production'); ?>"><h3>Audio/Visual</h3></a>
            
            <p>Audio recordings (including music and spoken word), video clips, interviews, conference sessions, live programs</p>
        
        </div>
    
    </div>
    
    <div class="row">

        <div id="discussion-points" class="four columns alpha">
        
            <a href="<?php echo ('items/browse/type/discussion%20points'); ?>"><h3>Discussion Points</h3></a>
            
            <p>Questions to guide readers and conversation groups through each book</p>
                    
        </div>

        <div id="websites" class="four columns">
        
            <a href="<?php echo ('items/browse/type/website'); ?>"><h3>Websites</h3></a>
            
            <p>Annotated web links for further exploration of program themes and context for specific books, as well as programming ideas and resources</p>
        
        </div>
        
        <div id="oiso" class="four columns omega">
        
            <a href="<?php echo ('items/browse/type/reference%20article'); ?>"><h3>Reference Articles</h3></a>
            
            <p>Reprinted from Oxford Islamic Studies Online</p>
        
        </div>
    
    </div>

</div>