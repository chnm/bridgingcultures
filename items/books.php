<nav id="page-menu" class="five columns alpha">

    <?php 
    $imageFile = get_db()->getTable('File')->findWithImages($item->id, 0);
    if(($fullsizeHtml = display_file($imageFile, array('imageSize' => 'fullsize', 'linkAttributes' => array('class' => 'lightbox book-image', 'data-ob' => 'lightbox')), array('class' => 'book-image')))):
        echo $fullsizeHtml;
    else:
        echo '<p class="no-image">No book cover.</p>';
    
    endif; ?>
    
    <ul>
        <?php if(item('Item Type Metadata', 'Author Biography')): ?>                
            <li><a href="#author">Author</a></li>
        <?php endif; ?>
        <?php if($resources = mj_get_related_to_book_or_essay()): ?>
            <?php usort($resources, 'bc_compare_related_items'); ?>
            <li><a href="#resources">Related Resources</a></li>
        <?php endif; ?>
            <li><a href="#cite">How to Cite This Page</a></li>
    </ul>
</nav>

<div id="right-content" class="ten columns offset-by-one omega">

    <h3 class="book-theme">
    <?php if($themes =  multicollections_get_collections_for_item()):
        $themesCount = count($themes);
        $i = 0;
        foreach($themes as $theme) {
            echo '<a href="' . uri('themes/show/' . $theme->id) . '">' . $theme->name . '</a>';
            $i++;
            if($i < $themesCount) {
                echo ', ';
            }
        } ?>
    <?php endif; ?>
    </h3>
    <?php if(count(item('Dublin Core', 'Title', array('all' => true))) > 1): ?>
    <h2 class="book-title"><?php echo item('Dublin Core', 'Title', array('index' => 1)); ?><br>
    <?php else: ?>
    <h2 class="book-title"><?php echo item('Dublin Core', 'Title'); ?><br>
    <?php endif; ?>
    <span class="book-author">by <?php echo item('Dublin Core', 'Creator'); ?></span></h2>
    
    <br />

    <?php if(item('Dublin Core', 'Description')): ?>
        <?php echo item('Dublin Core', 'Description'); ?>
    <?php endif; ?>

    <?php if(item('Dublin Core', 'Source')): ?>                
        <p><?php echo item('Dublin Core', 'Source'); ?></p>
    <?php endif; ?>
    
    <?php if(item('Item Type Metadata', 'Author Biography')): ?>
    
        <h3><a name="author"></a>Author</h3>
        
        <?php echo item_thumbnail(array('class' => 'author-image'), 1); ?>
        
        <p><?php echo item('Item Type Metadata', 'Author Biography'); ?></p>
        
    <?php endif; ?>
                    
    <?php if($resources): ?>
    
        <h3><a name="resources"></a>Related Resources</h3>
        
        <ul class="related-resources">
    
        <?php set_items_for_loop($resources);
            
        while(loop_items()):
        
            echo '<li>';
            echo link_to_item(item('Dublin Core', 'Title'));
            if ($description = item('Dublin Core', 'Description', array('snippet'=>150))):
                echo '<p>' . $description . '</p>';
            endif;
            echo '</li>';
            
        endwhile; ?>
        
        </ul>
        
    <?php endif; ?>

    <a name="cite"></a><h3>How to Cite This Page</h3>
    
    <p>"Muslim Journeys | Item #<?php echo item('id'); ?>: <?php echo item('Dublin Core', 'Title', array('index' => 1)); ?>", <?php echo date('F d, Y'); ?> <?php echo item('permalink'); ?>.</p>
    
    <?php if(item_has_tags()): ?>
    
    <h3>Tags</h3>
    
    <p><?php echo item_tags_as_string(); ?></p>
    
    <?php endif; ?>
    
</div>