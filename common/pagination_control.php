<?php
if ($this->pageCount > 1):
    $getParams = $_GET;
?>

<ul class="pagination" role="menubar" aria-label="Pagination">
    <!-- Previous Page Button -->
    <?php if (isset($this->previous)): ?>
        <?php $getParams['page'] = $previous; ?>
        <li class="arrow"><a rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">&laquo; Previous</a></li>
    <?php endif; ?>
    
    <li class="current"><a href=""><?php echo $this->current." of ".$this->last; ?></a></li>
    

    <!-- Next Page Button -->
    <?php if (isset($this->next)): ?>
        <?php $getParams['page'] = $next; ?>
        <li class="arrow"><a rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">Next &raquo;</a></li>
    <?php endif; ?>
</ul>

<?php endif; ?>