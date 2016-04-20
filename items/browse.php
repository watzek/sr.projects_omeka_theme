<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>
<?php endif; ?>

<style>
	.item-list{
		margin-bottom: 20px;
	}
	.item-list img{
		margin-bottom: 20px;
	}
	.item-list p{
		margin-bottom: 10px;
	}

	
	* { box-sizing: border-box; }

	/* ---- grid ---- */

	.grid {
	  max-width: 1000px;
	}

	/* clearfix */
	.grid:after {
	  content: '';
	  display: block;
	  clear: both;
	}

	/* ---- grid-item ---- */

	.grid-item {
	  width: 300px;
	  /*height: 600px;*/
	  float: left;
	  background: #7DA3A1;
	  border: 2px solid #333;
	  border-color: hsla(0, 0%, 0%, 0.5);
	  border-radius: 5px;
	  margin-bottom: 20px;
	  margin-left: 10px;
	}
	.grid-item img{
		width: 100%;
		height: 296px;
	}
	.grid-item p{
		margin-bottom: 10px;
	}
	.grid-item a{
		color: #0000b5;
	}
	.grid-item h5{
		padding: 3px; 3px 0 3px;
	}
</style>

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

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
