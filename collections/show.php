<?php queue_js('orangebox.min'); ?>

<?php head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>

<div class="five columns alpha theme-meta">

<?php 
$themeIcon = multicollections_get_items_in_collection(1,'Theme Icon');
if ($themeIcon):
    echo item_fullsize(array('class' => 'theme-icon', 'alt' => 'Collection'), 0, $themeIcon[0]);
    echo '<div class="credit">' . item('Item Type Metadata', 'Credit', array(), $themeIcon[0]) . '</div>';
else:   
    // Message if there are no items
    echo '<p>Theme icon missing.</p>';
endif; 
?>
    
<h2>Book List</h2>

<?php 

    switch (collection('name')) {
        case 'American Stories':
            $multiItems = array(
                get_item_by_id(19),
                get_item_by_id(25),
                get_item_by_id(43),
                get_item_by_id(18),
                get_item_by_id(107),
                get_item_by_id(75)
            );
            break;
        case 'Connected Histories':
            $multiItems = array(
                get_item_by_id(38),
                get_item_by_id(20),
                get_item_by_id(37),
                get_item_by_id(36),
                get_item_by_id(27)
            );
            break;
        case 'Literary Reflections':
            $multiItems = array(
                get_item_by_id(22),
                get_item_by_id(23),
                get_item_by_id(40),
                get_item_by_id(41),
                get_item_by_id(17)
            );
            break;
        case 'Pathways of Faith':
            $multiItems = array(
                get_item_by_id(33),
                get_item_by_id(21),
                get_item_by_id(43),
                get_item_by_id(39),
                get_item_by_id(31),
                get_item_by_id(32),
                get_item_by_id(90)
            );
            break;
        case 'Points of View':
            $multiItems = array(
                get_item_by_id(35),
                get_item_by_id(44),
                get_item_by_id(30),
                get_item_by_id(34),
                get_item_by_id(41)
            );
            break;
        case 'Art Spots':
            $multiItems = array(
                get_item_by_id(24),
                get_item_by_id(32),
                get_item_by_id(5)
            );
            break;
        default:
            $multiItems = array();
    }

?>

<?php 
if ($multiItems):
    foreach($multiItems as $multiItem) {
        set_current_item($multiItem);
        if (item_has_type('Book') || $multiItem->hasTag('bookshelf')) {
            if ($fullsizeHtml = item_thumbnail(array('class' => 'theme-book-cover', 'alt' => item('Dublin Core','Title')))) {
                echo '<div class="theme-book">';
                echo '<a href="'.item('permalink').'">'.$fullsizeHtml.'</a>';
                echo '<p class="theme-book-meta three columns omega"><span class="theme-book-title">';
                echo bc_link_to_item($multiItem);
                echo '</span><br>';
                if (item('Dublin Core', 'Creator')) {
                    echo '<span class="theme-book-author">by ' . item('Dublin Core','Creator') . '</span>';
                }
                echo '</p>';
                echo '</div>';
            }
        }
    }
else:
    echo '<p>No books for this theme.</p>';
endif; 
?>

</div>

<div class="ten columns offset-by-one omega">

    <h1><?php echo __(collection('name')) ?></h1>
    
    <?php if (collection('name') == 'Art Spots'): ?>
        
        <?php $videos = get_items(array('tags' => 'video essays')); ?>
        
        <p>The Islamic Art Spots are seven visual essays, presented in a series of short films designed to make art from Muslim societies an integral part of the Muslim Journeys experience.</p>

        <p>The Art Spots were written and presented by D. Fairchild Ruggles, Professor of Art, Architecture, and Landscape History, University of Illinois, Urbana-Champaign, and produced by Twin Cities Public Television.</p>
        
        <?php foreach ($videos as $video): ?>
            <?php set_current_item($video); ?>
            <div class="video-essay">
            <?php echo link_to_item(item_thumbnail()); ?>
            <?php echo link_to_item(item('Dublin Core','Title')); ?>
            </div>
        <?php endforeach; ?>
        
        <p class="credits"><a href="<?php echo uri('themes/muslimjourneys/files/ArtSpotsCredits.pdf'); ?>">(Click here for sources used in the Art Spots videos.)</a></p>

    <?php endif; ?>
    
<?php 
if ($multiItems = multicollections_get_items_in_collection(1, 'Theme Introduction')):
    set_current_item($multiItems[0]);                            
    echo '<h2 class="essay">Introduction</h2>';
    echo '<p class="essay-author">by '.item('Dublin Core','Creator').'</p>';
    echo item('Dublin Core','Description');
    
    if ($essay = multicollections_get_items_in_collection(1, 'Essay')):
        set_current_item($essay[0]);
        echo '<h2>For more on the ' . collection('name') . ' theme&hellip;</h2>';
        echo '<p>' . link_to_item( 'Read the full essay on the Web', array('class' => 'theme-essay')) . '</p>'; 
        if (item_has_files()):
            while(loop_files_for_item()):
                if (item_file('MIME Type') == 'application/pdf'):
                    echo '<p><a href="' . item_file('uri') . '" class="theme-pdf">Download the full essay PDF</a></p>';
                endif;
            endwhile;
        endif;
    endif;

    set_current_item($multiItems[0]);                                
    echo '<h2 class="author-bio">About ' . item('Dublin Core', 'Creator') .'</h2>'; 
    echo item_thumbnail(array('class'=>'author-image'));
    echo '<p>' . item('Item Type Metadata','Author Biography') . '</p>';
else:
    echo '<p>No essay for this theme.</p>';
endif; 
?>

</div>

<?php foot(); ?>