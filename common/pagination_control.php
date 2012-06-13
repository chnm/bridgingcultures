<?php if ($this->pageCount > 1): ?>

<div class="pagination">

<p><?php echo __('Page ') . $this->current . __(' of ') . $this->last; ?></p>

<ul class="pagination_list">
    
    <?php if (isset($this->previous)): ?>
    <!-- Previous page link --> 
        <?php if(isset($this->next)): ?>
        <li class="pagination_previous both">
        <?php else: ?>
        <li class="pagination_previous">
        <?php endif; ?>
    <a href="<?php echo html_escape($this->url(array('page' => $this->previous), null, $_GET)); ?>"><?php echo __('Previous'); ?></a>
    </li>
    <?php endif; ?>
        
    <?php if (isset($this->next)): ?> 
    <!-- Next page link -->
        <?php if(isset($this->previous)): ?>
        <li class="pagination_next both">
        <?php else: ?>
        <li class="pagination_next">
        <?php endif; ?>
    <a href="<?php echo html_escape($this->url(array('page' => $this->next), null, $_GET)); ?>"><?php echo __('Next'); ?></a>
    </li>
    <?php endif; ?>

</ul>

</div>
<?php endif; ?>
