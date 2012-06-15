<?php head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>

<div class="five columns offset-by-one alpha theme-meta">

<?php $themeIcon = multicollections_get_items_in_collection(1,'Theme Icon');
    if($themeIcon):
        echo item_fullsize(array('class' => 'theme-icon', 'alt' => 'Collection'), 0, $themeIcon[0]);
    else: ?>     
        <!-- Message if there are no items -->
        <p>Theme icon missing.</p>
    <?php endif; ?>
    
<h2>Book List</h2>
    
<?php if($multiItems = multicollections_get_items_in_collection(10, 'Book')):
    foreach($multiItems as $multiItem) {
        set_current_item($multiItem);
        if($fullsizeHtml = item_thumbnail(array('class' => 'theme-book-cover', 'alt' => item('Dublin Core','Title')))) {
            echo '<div class="theme-book">';
            echo '<a href="'.item('permalink').'">'.$fullsizeHtml.'</a>';
            echo '<p class="theme-book-meta three columns omega"><span class="theme-book-title">'.link_to_item().'</span><br><span class="theme-book-author">by '.item('Dublin Core','Creator').'</span></p>';
            echo '</div>';
        }
    }
else:
    echo '<p>No books for this theme.</p>';
endif; 
?>

</div>

<div class="nine columns">

    <h1><?php echo __('Theme: ' . collection('name')) ?></h1>

<?php if($multiItems = multicollections_get_items_in_collection(1, 'Essay')):
        set_current_item($multiItems[0]);                            
        echo '<h2 class="essay">'.item('Dublin Core','Title').'</h2>';
        echo '<p class="essay-author">by '.item('Dublin Core','Creator').'</p>';
        echo item('Dublin Core','Description');
        echo '<h2 class="author-bio">About ' . item('Dublin Core', 'Creator') .'</h2>'; 
        echo item_thumbnail(array('class'=>'author-image'));
        echo item('Item Type Metadata','Author Biography');
else:
    echo '<p>No essay for this theme.</p>';
endif; 
?>

</div>

<?php foot(); ?>