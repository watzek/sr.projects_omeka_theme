<?php $pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<!-- <h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1> -->
<?php echo pagination_links(); ?>

<br />
<?php
    $sortLinks[__('Title')] = 'Dublin Core,Title';
    $sortLinks[__('Date Added')] = 'added';
    $items_per_page = get_option('per_page_public');
    $total_collections = 0;
    foreach (loop('collections') as $collection):
    	$total_collections++;
    endforeach;
?>

<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>
<div class="container">
	<div class="row">
	<?php
	$col_counter = 1;
	$total_counter = 1;
	foreach (loop('collections') as $collection):

		//check if $col_counter = 4 or $total_counter = 10 to add "end" class
		if ($col_counter==4 || $total_counter==$items_per_page || $total_counter==$total_collections){?>
			<div class="small-3 columns collection-col end">
		<?php }else{ ?>
			<div class="small-3 columns collection-col">
		<?php } //all the data of goes here:?>
			    <a href ="/items/browse?collection=<?php echo metadata('collection', 'id');?>">
			    <!--	<img class="collection_image" src="<?php #echo src((metadata('collection', array('Dublin Core', 'Source'))), 'images/collection_thumb'); ?>" />-->
			   <?php
			     $x= metadata('collection', array('Dublin Core', 'Source'));
      echo "<img src='https://watzek.lclark.edu/seniorprojects".$x."'>";
			   ?>
			   
			    </a>
   				<h3><?php echo link_to_items_browse(__(metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></h3>

			</div><!-- end class="small-3" -->

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

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<script type="text/javascript">
	//Scroll effect Javascript using scrollreveal by RJ 05/12/16
	var colReveal = {
		delay : 200,
		duration: 800,
		useDelay: 'always',
		distance: '100px',
		easing : 'ease-in-out',
		reset: false,
		viewOffset: {top: 64}
	}
	window.sr = ScrollReveal();
	sr.reveal('.collection-col', colReveal);
</script>

<?php echo foot(); ?>
