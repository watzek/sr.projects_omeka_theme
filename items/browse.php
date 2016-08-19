<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<!-- <h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1> -->

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<div class="pagination-centered"><?php echo pagination_links(); ?></div>

<div class="grid">
  	<?php foreach (loop('items') as $item): ?>
		<div class="grid-item">
			<?php if (metadata('item', 'has files')): ?>
				<?php echo link_to_item(item_image('square_thumbnail')); ?>
    		<?php endif; ?>
			<h5 class="text-center"><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h5>
			<p class="text-center"><strong>Author: </strong><?php echo metadata('item', array('Dublin Core', 'Creator')); ?> </p>
			<p class="text-center"><strong>Year Published: </strong><?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>
    		<p class="text-center"><strong>Department: </strong><?php
    		if(metadata('item','Collection Name')):
    			echo link_to_items_browse(metadata('item','Collection Name'), array('collection' => metadata('item', 'Collection ID')));
    		endif; ?></p>
		</div>
  	<?php endforeach;?>
</div>

<div class="pagination-centered"><?php echo pagination_links(); ?></div>

<div class="row item-row">
	<?php foreach (loop('items') as $item): ?>
		<div class="item-list"> <hr />
		<?php if (metadata('item', 'has files')): ?>
    		<div class="large-4 columns">
        		<?php echo link_to_item(item_image('square_thumbnail')); ?>
    		</div>
    	<?php endif; ?>
    		<div class="large-8 columns">
    			<h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h4>
    			<p><strong>Author: </strong><?php echo metadata('item', array('Dublin Core', 'Creator')); ?> </p>
    			<p><strong>Year Published: </strong><?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>
    			<p><strong>Department: </strong><?php
    				if(metadata('item','Collection Name')):
    					echo link_to_items_browse(metadata('item','Collection Name'), array('collection' => metadata('item', 'Collection ID')));
    				endif;
    			?></p>
    		</div>
		</div>
	<?php endforeach;?>
</div>

<div class="pagination-centered"><?php echo pagination_links(); ?></div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
