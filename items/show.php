<?php head(array('title' => item('Dublin Core', 'Title'),'bodyid'=>'item','bodyclass' => 'show item')); ?>

    <?php if(item_has_type('Book')): ?>

        <nav id="page-menu" class="four columns offset-by-one alpha">
        
            <?php if(($fullsizeHtml = item_fullsize(array('class'=>'book-image')))):
                echo $fullsizeHtml;
                
            else:
                echo '<p class="no-image">No book cover.</p>';
            
            endif; ?>
            
            <ul>
                <li><a href="#summary">Book Summary</a></li>
                <li><a href="#author">About the Author</a></li>
                <li>Reader's Guide</li>
                <li>Links to Resources</li>
            </ul>
                        
            <p id="jquery-test">&nbsp;</p>
        
        </nav>
        
        <div id="right-content" class="nine columns">
        
            <h3 class="book-theme">
            <?php if($themes =  multicollections_get_collections_for_item()):
                $themesCount = count($themes);
                $i = 0;
                if($themesCount > 1) {
                    echo 'Themes: ';
                } else {
                    echo 'Theme: ';
                }
                foreach($themes as $theme) {
                    echo link_to_collection($theme->name, array(), 'show', $theme);
                    $i++;
                    if($i < $themesCount) {
                        echo ', ';
                    }
                } ?>
            <?php endif; ?>
            </h3>
            <h2 class="book-title"><?php echo item('Dublin Core', 'Title'); ?><br>
            <span class="book-author">by <?php echo item('Dublin Core', 'Creator'); ?></span></h2>
            
            <div class="book summary">
                
                <?php if(item('Dublin Core', 'Description')): ?>
                
                    <h4><a name="summary"></a>Book Summary</h4>
                    
                <?php endif; ?>
            
                <?php echo item('Dublin Core', 'Description'); ?>
                
                <?php if(item('Item Type Metadata', 'Author bio')): ?>
                
                    <h4><a name="author"></a>About the Author</h4>
                    
                    <?php echo item('Item Type Metadata', 'Author bio'); ?>
                    
                <?php endif; ?>
                                
                <?php if($resources = mj_get_related_to_book_or_essay()): ?>
                
                    <h4>Resources</h4>
                    
                    <ul>
                
                    <?php set_items_for_loop($resources);
                        
                    while(loop_items()):
                    
                        echo '<li>' . link_to_item(item('Dublin Core', 'Title')) . '</li>';
                        
                    endwhile; ?>
                    
                    </ul>
                    
                <?php endif; ?>
                
            </div>
        
        </div>
    
    <?php else: ?>
        
        <nav id="page-menu" class="five columns offset-by-one alpha">
        
            <?php if(($fullsizeHtml = item_fullsize(array('class'=>'book-image')))):
                echo $fullsizeHtml;
                
            else:
                echo '<p class="no-image">No image.</p>';
            
            endif; ?>
                                    
            <p id="jquery-test">&nbsp;</p>
            
            <h4>Related Books</h4>
            
            <?php if($relatedBooks = mj_get_related_items()): 
                set_items_for_loop($relatedBooks);
                echo '<ul>';
                while(loop_items()):
                    if($fullsizeHtml = item_fullsize(array('class' => 'theme-book-cover', 'alt' => item('Dublin Core','Title')))) {
                        echo '<div class="theme-book">';
                        echo '<a href="'.item('permalink').'">'.$fullsizeHtml.'</a>';
                        echo '<p class="theme-book-meta three columns omega"><span class="theme-book-title">'.link_to_item().'</span><br><span class="theme-book-author">by '.item('Dublin Core','Creator').'</span></p>';
                        echo '</div>';
                    }
                endwhile;
            endif;
                
            
            ?>
            

        
        </nav>
        
        <div id="right-content" class="eight columns offset-by-one">
        
            <?php echo show_item_metadata(); ?>
        
        </div>
    
    <?php endif; ?>

<?php foot(); ?>