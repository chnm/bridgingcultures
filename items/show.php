<?php queue_js(array('quickpager.jquery','orangebox.min')); ?>

<?php head(array(
        'title' => item('Dublin Core', 'Title'),
        'bodyid'=> (item_has_type('News/Feature Post') ? 'simple-page' : 'item'),
        'bodyclass' => 'show item')
      ); 

      $currentItemId = item('id');
?>

    <?php if(item_has_type('Book')): ?>

        <?php include('books.php'); ?>
        
    <?php elseif (item_has_type('Essay')): ?>
    
        <?php include('essay.php'); ?>

    <?php elseif (item_has_type('News/Feature Post')): ?>
        
        <?php include('news.php'); ?>
    
    <?php else: ?>
        
        <nav id="page-menu" class="five columns alpha">

            <?php set_current_item(get_item_by_id($currentItemId)); ?>
            <?php $artspots = false; ?>
            <?php if($themes =  multicollections_get_collections_for_item()):
                $themesCount = count($themes);
                $i = 0;
                foreach($themes as $theme) {
                    if($theme->name == 'Art Spots') { $artspots = true; }
                    $i++;
                } ?>
            <?php endif; ?>

            <?php 
            
            $audioTypes = array(
                'audio/aac','audio/aiff','audio/mid','audio/midi','audio/mp3',
                'audio/mp4','audio/mpeg','audio/mpeg3','audio/ogg','audio/wav',
                'audio/wma','audio/x-aac','audio/x-aiff','audio/x-midi','audio/x-mp3',
                'audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-mpegaudio','audio/x-ms-wax',
                'audio/x-realaudio','audio/x-wav','audio/x-wma'
            );
            
            $videoTypes = array(
                'video/avi','video/divx','video/mp4','video/mpeg','video/msvideo',
                'video/ogg','video/quicktime','video/x-ms-wmv','video/x-msvideo', 'video/m4v'
            );

            if(item_has_files() && $artspots == false):
                foreach($item->Files as $file) {
                    $wrapper = false;
                    if(array_search($file->getMimeType(), $videoTypes) !== false) {
                        echo '<a href="#video" data-ob="lightbox" data-ob_width="640" class="video-preview"><img src="' . uri('themes/muslimjourneys/images/audio.jpg') . '"></a>';
                        $wrapper = true;
                        echo '<div id="video" style="width: 600px; height: 340px;">';
                        echo display_file( $file, 
                            array(
                              'linkToFile' => true,
                              'linkAttributes' => array('data-ob_iframe' => true, 'data-ob' => 'lightbox'),
                              'width' => 600,
                              'height' => 340
                            )
                        );
                    } elseif(array_search($file->getMimeType(), $audioTypes) !== false) {
                        echo '<a href="#audio" data-ob="lightbox" data-ob_width="640" class="video-preview"><img src="' . uri('themes/muslimjourneys/images/audio.jpg') . '"></a>';
                        echo '<div id="audio">';
                        echo display_file( $file, 
                            array(
                              'linkToFile' => true,
                              'linkAttributes' => array('data-ob_iframe' => true, 'data-ob' => 'lightbox'),
                            )
                        );
                        $wrapper = true;
                    } elseif($imageFile = get_db()->getTable('File')->findWithImages($item->id, 0)) {
                            $fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox' )), array('class' => 'book-image'));
                            echo $fullsizeHtml;
                            break;
                    }
                    if ($wrapper) { 
                        echo '</div>'; 
                        break;
                    }
                }
            elseif($embed = item('Item Type Metadata', 'Embed code')):
                echo '<a href="#video" data-ob="lightbox" data-ob_width="640" class="video-preview"><img src="' . uri('themes/muslimjourneys/images/audio.jpg') . '"></a>';
                echo '<div id="video" style="width: 640px; height: 364px;">';
                echo $embed;
                echo '</div>';
            elseif($imageFile = get_db()->getTable('File')->findWithImages($item->id, 0)):
                $fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox' )), array('class' => 'book-image'));
                echo $fullsizeHtml;
            else:
                echo '<p class="no-image">No image.</p>';
            endif; ?>
            
            <ul>

                <?php if(item('Dublin Core', 'Description')): ?>                
                <li><a href="#about">About This Resource</a></li>
                <?php endif; ?>

                <?php if(item('Item Type Metadata', 'Text')): ?>                
                <li><a href="#text">Text</a></li>
                <?php endif; ?>

                <?php if(item('Item Type Metadata', 'Transcription')): ?>                
                <li><a href="#transcription">Transcription</a></li>
                <?php endif; ?>

                <li><a href="#source">Source</a></li>

                <li><a href="#cite">How to Cite This Page</a></li>

            </ul>
                                                
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
        
        <div id="right-content" class="ten columns offset-by-one omega">
            <h3 class="book-theme">
            <?php set_current_item(get_item_by_id($currentItemId)); ?>            
            <?php $themesCount = count($themes);
                $i = 0;
                foreach($themes as $theme) {
                    echo '<a href="' . uri('themes/show/' . $theme->id) . '">' . $theme->name . '</a>';
                    $i++;
                    if($i < $themesCount) {
                        echo ', ';
                    }
                } ?>
            </h3>
                      
            <h2 class="item-title"><?php echo item('Dublin Core', 'Title'); ?></h2>
            
            <?php if (item_has_files()): ?>
                <?php while(loop_files_for_item()): ?>
                    <?php if (item_file('MIME Type') == 'application/pdf'): ?>
                        <p class="discussion"><a href="<?php echo item_file('uri'); ?>" class="theme-pdf">Download PDF of <?php echo item('Dublin Core', 'Title'); ?></a></p>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            
            <?php if (item('Dublin Core', 'Description')): ?>
                <a name="about"></a><h3>About This Resource</h3>
                <p><?php echo item('Dublin Core', 'Description'); ?></p>
            <?php endif; ?>

            <?php if (item('Item Type Metadata', 'Text')): ?>
                <h3><a name="text">Text</a></h3>
                <div class="text"><?php echo item('Item Type Metadata', 'Text'); ?></div>
            <?php endif; ?>

            <?php if (item('Item Type Metadata', 'Transcription')): ?>
                <h3><a name="transcription">Transcription</a></h3>
                <?php echo item('Item Type Metadata', 'Transcription'); ?>
            <?php endif; ?>

            <?php if(item('Dublin Core', 'Source')): ?>

                <a name="source"></a><h3>Source</h3>
                
                <p><?php echo item('Dublin Core', 'Source'); ?></p>
                
            <?php endif; ?>
            
            <a name="cite"></a><h3>How to Cite This Page</h3>
            
            <p>"Muslim Journeys | Item #<?php echo item('id'); ?>: <?php echo item('Dublin Core', 'Title'); ?>", <?php echo date('F d, Y'); ?> <?php echo item('permalink'); ?>.</p>
            
            <?php if(item_has_tags()): ?>
            
            <h3>Tags</h3>
            
            <p><?php echo item_tags_as_string(); ?></p>
            
            <?php endif; ?>
            
        </div>
    
    <?php endif; ?>

<?php foot(); ?>