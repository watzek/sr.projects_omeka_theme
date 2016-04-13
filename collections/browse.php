<?php $pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>
<br />

<style>
	.collection-col{
		background-color: gray;
		height: 300px;
	}
</style>

<br />
<?php
    $sortLinks[__('Title')] = 'Dublin Core,Title';
    $sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php
	$items_per_page = get_option('per_page_public');
?>

<div class="container">
	<div class="row">
	<?php
	$col_counter = 1;
	$total_counter = 1;
	//echo "Total collections = ".count('collections');
	foreach (loop('collections') as $collection):

		//check if $col_counter = 4 or $total_counter = 10 to add "end" class
		if ($col_counter==4 || $total_counter==$items_per_page){?>
			<div class="small-3 columns collection-col end">
		<?php }else{ ?>
			<div class="small-3 columns collection-col">
		<?php } //all the data of goes here:?>
			...</div><!-- end class="small-3" -->

		<?php
			  if($col_counter == 4){
			  	$col_counter = 1;
			  }
			  else{
				  $col_counter++;
			  }
			  $total_counter++;
		?>
	<?php endforeach; ?>
	</div><!-- end class="row" -->
</div><!-- end class="container" -->
<br />

<?php foreach (loop('collections') as $collection): ?>

<div class="collection">

    <h2><?php echo link_to_collection(); ?></h2>

    <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
        <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
    <?php endif; ?>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div class="collection-description">
        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
    </div>
    <?php endif; ?>

    <?php if ($collection->hasContributor()): ?>
    <div class="collection-contributors">
        <p>
        <strong><?php echo __('Contributors'); ?>:</strong>
        <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
        </p>
    </div>
    <?php endif; ?>

    <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

</div><!-- end class="collection" -->

<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
