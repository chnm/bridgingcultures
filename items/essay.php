<nav id="page-menu" class="five columns alpha">

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
    
    <?php
    set_current_item(get_item_by_id($currentItemId));
    ?>
    <h2 class="item-title"><?php echo item('Dublin Core', 'Title'); ?></h2>
    <p class="essay-author">by <?php echo item('Dublin Core','Creator'); ?></p>

    
    <script type="text/javascript">
    jQuery(function() {
        jQuery("div.paging").quickPager( {
           pageSize: 15,
           pagerLocation: "both",
           viewSinglePage: true
        });
    });
    </script>

    
    <div class="paging">
                
    <?php echo item('Dublin Core', 'Description'); ?>
    
    </div>
    
    
</div>