<?php
if ($this->pageCount > 1):
    $getParams = $_GET;

    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    $current_page = $this->current;
    $prev = $current_page - 1;
    $next = $current_page + 1;
    $lastpage = $this->pageCount;
    $lpm1 = $lastpage - 1;

?>

<ul class="pagination" role="menubar" aria-label="Pagination">
    <!-- Previous Page Button -->
    <?php if (isset($this->previous)): ?>
        <?php $getParams['page'] = $previous; ?>
        <li class="arrow"><a rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">&laquo; Previous</a></li>
    <?php endif; ?>

    <?php
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $current_page){
                    ?>
                        <li class="current"><a href=""><?php echo $this->current; ?></a></li>
                    <?php
                }else{
                    $getParams['page'] = $counter;
                    ?>
                        <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $counter; ?></a></li>
                    <?php               
                }
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2)){
            //close to beginning; only hide later pages
            if($current_page < 1 + ($adjacents * 2)){
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $current_page){
                        ?>
                            <li class="current"><a href=""><?php echo $this->current; ?></a></li>
                        <?php
                    }else{
                        $getParams['page'] = $counter;
                        ?>
                            <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $counter; ?></a></li>
                        <?php
                    }
                }
                ?>
                    <li class="unavailable" aria-disabled="true"><a href="">&hellip;</a></li>
                <?php
                    $getParams['page'] = $lpm1;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $lpm1; ?></a></li>
                <?php
                    $getParams['page'] = $lastpage;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $lastpage; ?></a></li>
                <?php
            }

            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $current_page && $current_page > ($adjacents * 2))
            {
                $getParams['page'] = 1;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">1</a></li>
                <?php
                $getParams['page'] = 2;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">2</a></li>
                    <li class="unavailable" aria-disabled="true"><a href="">&hellip;</a></li>
                <?php
                for ($counter = $current_page - $adjacents; $counter <= $current_page + $adjacents; $counter++)
                {
                    if ($counter == $current_page){
                        ?>
                            <li class="current"><a href=""><?php echo $this->current; ?></a></li>
                        <?php
                    }else{
                        $getParams['page'] = $counter;
                        ?>
                            <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $counter; ?></a></li>
                        <?php
                    }       
                }
                ?>
                    <li class="unavailable" aria-disabled="true"><a href="">&hellip;</a></li>
                <?php
                    $getParams['page'] = $lpm1;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $lpm1; ?></a></li>
                <?php
                    $getParams['page'] = $lastpage;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $lastpage; ?></a></li>
                <?php     
            }

            //close to end; only hide early pages
            else
            {
                $getParams['page'] = 1;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">1</a></li>
                <?php
                $getParams['page'] = 2;
                ?>
                    <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">2</a></li>
                    <li class="unavailable" aria-disabled="true"><a href="">&hellip;</a></li>
                <?php
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $current_page){
                        ?>
                            <li class="current"><a href=""><?php echo $this->current; ?></a></li>
                        <?php
                    }else{
                        $getParams['page'] = $counter;
                        ?>
                            <li><a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo $counter; ?></a></li>
                        <?php
                    }                   
                }
            }
        }
    ?>

    <!-- Next Page Button -->
    <?php if (isset($this->next)): ?>
        <?php $getParams['page'] = $next; ?>
        <li class="arrow"><a rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">Next &raquo;</a></li>
    <?php endif; ?> 
</ul>

<?php endif; ?>