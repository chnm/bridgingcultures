<?php head(array('title' => item('Dublin Core', 'Title'),'bodyid'=>'item','bodyclass' => 'show item')); 
$currentItemId = item('id');
?>

    <?php if(item_has_type('Book')): ?>

        <nav id="page-menu" class="four columns offset-by-one alpha">
        
            <?php 
            $imageFile = get_db()->getTable('File')->findWithImages($item->id, 0);
            if(($fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox')), array('class' => 'book-image')))):
                echo $fullsizeHtml;
            else:
                echo '<p class="no-image">No book cover.</p>';
            
            endif; ?>
            
            <ul>
                <?php if(item('Dublin Core', 'Description')): ?>                
                    <li><a href="#summary">Book Summary</a></li>
                <?php endif; ?>
                <?php if(item('Item Type Metadata', 'Author Biography')): ?>                
                    <li><a href="#author">About the Author</a></li>
                <?php endif; ?>
                    <li><a href="#annotation">Annotation</a></li>
                <?php if($resources = mj_get_related_to_book_or_essay()): ?>
                    <li><a href="#resources">Related Resources</a></li>
                <?php endif; ?>
            </ul>
                                
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
            <?php if(count(item('Dublin Core', 'Title', array('all' => true) > 1))): ?>
            <h2 class="book-title"><?php echo item('Dublin Core', 'Title', array('index' => 1)); ?><br>
            <?php else: ?>
            <h2 class="book-title"><?php echo item('Dublin Core', 'Title'); ?><br>
            <?php endif; ?>
            <span class="book-author">by <?php echo item('Dublin Core', 'Creator'); ?></span></h2>
            
            <div class="book summary">
                
                <?php if(item('Dublin Core', 'Description')): ?>
                
                    <h3><a name="summary"></a>Book Summary</h3>
                    
                <?php endif; ?>
            
                <?php echo item('Dublin Core', 'Description'); ?>
                
                <?php if(item('Item Type Metadata', 'Author Biography')): ?>
                
                    <h3><a name="author"></a>About the Author</h3>
                    
                    <?php echo item_thumbnail(array('class' => 'author-image'), 1); ?>
                    
                    <p><?php echo item('Item Type Metadata', 'Author Biography'); ?></p>
                    
                <?php endif; ?>
                
                <h3><a name="annotation"></a>Annotation</h3>
                
                <?php echo item('Item Type Metadata', 'Text'); ?>
                
                <p>Region: <?php echo item('Item Type Metadata', 'Region'); ?></p>
                
                <p>Time Period: <?php echo item('Item Type Metadata', 'Time Period'); ?></p>
                                
                <h3>How to Cite This Source</h3>
                
                <p>"Muslim Journeys | Item #<?php echo item('id'); ?>: <?php echo item('Dublin Core', 'Title', array('index' => 1)); ?>", <?php echo date('F d, Y'); ?> <?php echo item('permalink'); ?>.</p>
                
                <?php if(item_has_tags()): ?>
                
                <h3>Tags</h3>
                
                <p><?php echo item_tags_as_string(); ?></p>
                
                <?php endif; ?>
                
                                
                <?php if($resources): ?>
                
                    <h3><a name="resources"></a>Related Resources</h3>
                    
                    <ul>
                
                    <?php set_items_for_loop($resources);
                        
                    while(loop_items()):
                    
                        echo '<li>' . link_to_item(item('Dublin Core', 'Title')) . '</li>';
                        
                    endwhile; ?>
                    
                    </ul>
                    
                <?php endif; ?>
                
            </div>
        
        </div>
        
    <?php elseif (item_has_type('Essay')): ?>
    
        <nav id="page-menu" class="five columns offset-by-one alpha">
        
            <?php 
            
            if($imageFile = get_db()->getTable('File')->findWithImages($item->id, 0)):
                $fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox' )), array('class' => 'book-image'));
                echo $fullsizeHtml;
            elseif(item_has_files()):
                echo display_files_for_item(
        		    array(
        		      'linkToFile' => true,
    		          'linkAttributes' => array('data-ob_iframe' => true, 'data-ob' => 'lightbox')
        		    )
        		);
            else:
                echo '<p class="no-image">No image.</p>';
            
            endif; ?>
                                                
        </nav>
        
        <div id="right-content" class="eight columns offset-by-one">
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
            
            <?php
            set_current_item(get_item_by_id($currentItemId));
            ?>
            <h2 class="item-title"><?php echo item('Dublin Core', 'Title'); ?></h2>
            
            
            <div class="paging">
                        
            <?php echo item('Dublin Core', 'Description'); ?>
            
            </div>
            
            
        </div>
    
    
    <?php else: ?>
        
        <nav id="page-menu" class="five columns offset-by-one alpha">
        
            <?php 
            
            $audioTypes = array('audio/aac','audio/aiff','audio/mid','audio/midi','audio/mp3','audio/mp4','audio/mpeg','audio/mpeg3','audio/ogg','audio/wav','audio/wma','audio/x-aac','audio/x-aiff','audio/x-midi','audio/x-mp3','audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-mpegaudio','audio/x-ms-wax','audio/x-realaudio','audio/x-wav','audio/x-wma');
            $videoTypes = array('video/avi','video/divx','video/mp4','video/mpeg','video/msvideo','video/ogg','video/quicktime','video/x-ms-wmv','video/x-msvideo', 'video/m4v');
            
            if($imageFile = get_db()->getTable('File')->findWithImages($item->id, 0)):
                $fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox' )), array('class' => 'book-image'));
                echo $fullsizeHtml;
            elseif(item_has_files()):
                foreach($item->Files as $file) {
                    if(array_search($file->getMimeType(), $videoTypes) !== false) {
                        echo '<a href="#video" data-ob="lightbox" data-ob_width="640" class="video-preview"><img src="' . uri('themes/muslimjourneys/images/audio.jpg') . '"></a>';
                        echo '<div id="video">';
                    } elseif(array_search($file->getMimeType(), $audioTypes) !== false) {
                        echo '<a href="#audio" data-ob="lightbox" data-ob_width="640" class="video-preview"><img src="' . uri('themes/muslimjourneys/images/audio.jpg') . '"></a>';
                        echo '<div id="audio">';
                    }                         
                    echo display_files_for_item(
            		    array(
            		      'linkToFile' => true,
        		          'linkAttributes' => array('data-ob_iframe' => true, 'data-ob' => 'lightbox'),
        		          'width' => 600
            		    )
            		);            
                    echo '</div>';
                }
            else:
                echo '<p class="no-image">No image.</p>';
            
            endif; ?>
                                                
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
            
            <?php
            set_current_item(get_item_by_id($currentItemId));
            ?>            
            <h2 class="item-title"><?php echo item('Dublin Core', 'Title'); ?></h2>
            
            <?php if (!item_has_type('Further Reading')): ?>
                <h3>Annotation</h3>
            <?php endif; ?>
            
            <?php if (!item_has_type('Further Reading')): ?>
                <p><?php echo item('Dublin Core', 'Description'); ?></p>
            <?php else: ?>
                <?php echo item('Item Type Metadata', 'Text'); ?>
            <?php endif; ?>
            
            <p><strong>Region:</strong> <?php echo item('Item Type Metadata', 'Region'); ?></p>
            
            <p><strong>Time Period:</strong> <?php echo item('Item Type Metadata', 'Time Period'); ?></p>
            
            <?php if(item('Dublin Core', 'Source')): ?>

                <h3>Source</h3>
                
                <p><?php echo item('Dublin Core', 'Source'); ?></p>
                
            <?php endif; ?>
            
            <h3>How to Cite This Source</h3>
            
            <p>"Muslim Journeys | Item #<?php echo item('id'); ?>: <?php echo item('Dublin Core', 'Title'); ?>", <?php echo date('F d, Y'); ?> <?php echo item('permalink'); ?>.</p>
            
            <?php if(item_has_tags()): ?>
            
            <h3>Tags</h3>
            
            <p><?php echo item_tags_as_string(); ?></p>
            
            <?php endif; ?>
        
        </div>
    
    <?php endif; ?>

<?php foot(); ?>