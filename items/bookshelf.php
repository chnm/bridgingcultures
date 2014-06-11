<h1>Browse the Bookshelf</h1>

<p>The Muslim Journeys Bookshelf collection consists of twenty-five books and three films, a collection of resources carefully curated to present to the American public new and diverse perspectives on the people, places, histories, beliefs, practices, and cultures of Muslims in the United States and around the world. <a href="<?php echo uri('about'); ?>">To learn more, read about the project here.</a></p>

<div id="books">

<?php 
    $i = 0;
    $bookItems = get_items(array('type' => 'Book'),30);
    $otherItems = get_items(array('tags' => 'bookshelf'),30);
    $bookshelfArray = array_merge($bookItems,$otherItems);
    foreach($bookshelfArray as $value) $bookshelfValues[serialize($value)] = $value;
    $bookshelfItems = array_values($bookshelfValues);
?>

<?php 

function cmp($a, $b) {
    return strcmp(item('Dublin Core','Title', array(), $a), item('Dublin Core','Title', array(), $b));    
} 

usort($bookshelfItems, "cmp");

?>

<?php set_items_for_loop($bookshelfItems); ?>

<?php while (loop_items()): ?>

    <?php $i++; ?>
    
    <?php if(($i%3) === 1 || $i === 1) : ?>
        
    <div class="row">
        
    <?php endif; ?>

        <div class="book five columns">        
    
            <div class="book-meta">
        
            <?php if (item_thumbnail()): ?>
                <div class="book-thumbnail two columns alpha">
                <?php echo link_to_item(item_thumbnail()); ?>
                </div>
            <?php endif; ?>
            
            <p class="three columns omega">
            <?php if(count(item('Dublin Core', 'Title', array('all' => true))) > 1): ?>
                <?php echo link_to_item(
                    '<span class="book-title">' . item('Dublin Core', 'Title', array('index' => 1)) . '</span><br>' . 
                    item('Dublin Core', 'Creator'),                     
                    array('class'=>'permalink')); ?>
            <?php else: ?>
                <?php echo link_to_item(
                    '<span class="book-title">' . item('Dublin Core', 'Title') . '</span><br>' . 
                    item('Dublin Core', 'Creator'),                     
                    array('class'=>'permalink')); ?>
            <?php endif; ?>                    
            </p>
                            
            </div><!-- end class="book-meta" -->
        </div><!-- end class="book" -->
    
    <?php if(($i%3) === 0) : ?>
        
        </div>
        
    <?php endif; ?>
                
<?php endwhile; ?>

</div>
