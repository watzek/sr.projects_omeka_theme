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
</style>

<div class="row item-row">
	<div class="item-list">
		<img src="http://sharonkgilbert.com/wp-content/uploads/2015/12/Under-construction.png" class="large-4 columns">
		<div class="large-8 columns">
			<h4>"He Always Advocated for Justice and Truth": The Mothers of Political Prisoners' Use of Combative Motherhood to Legitimize Human Rights in Kenyan Politics.</h4>
			<p><strong>Author: </strong>Hibdy Dibdy, Gibdy Dibdy, Jibdy, Dibdy</p>
			<p><strong>Year Published: </strong>1990</p>
			<p><strong>Department: </strong>The White House</p>
		</div>
	</div>
	<div class="item-list">
		<hr />
		<img src="https://cdn1.iconfinder.com/data/icons/professional-toolbar-icons-2/64/Under_construction.png" class="large-4 columns">
		<div class="large-8 columns">
			<h4>"He Always Advocated for Justice and Truth": The Mothers of Political Prisoners' Use of Combative Motherhood to Legitimize Human Rights in Kenyan Politics.</h4>
			<p><strong>Author: </strong>Hibdy Dibdy, Gibdy Dibdy, Jibdy, Dibdy</p>
			<p><strong>Year Published: </strong>1990</p>
			<p><strong>Department: </strong>The White House</p>
		</div>
	</div>
	<div class="item-list">
		<hr/>
		<img src="http://sharonkgilbert.com/wp-content/uploads/2015/12/Under-construction.png" class="large-4 columns">
		<div class="large-8 columns">
			<h4>"He Always Advocated for Justice and Truth": The Mothers of Political Prisoners' Use of Combative Motherhood to Legitimize Human Rights in Kenyan Politics.</h4>
			<p><strong>Author: </strong>Hibdy Dibdy, Gibdy Dibdy, Jibdy, Dibdy</p>
			<p><strong>Year Published: </strong>1990</p>
			<p><strong>Department: </strong>The White House</p>
		</div>
	</div>
	<div class="item-list">
		<hr />
		<img src="http://sharonkgilbert.com/wp-content/uploads/2015/12/Under-construction.png" class="large-4 columns">
		<div class="large-8 columns">
			<h4>"He Always Advocated for Justice and Truth": The Mothers of Political Prisoners' Use of Combative Motherhood to Legitimize Human Rights in Kenyan Politics.</h4>
			<p><strong>Author: </strong>Hibdy Dibdy, Gibdy Dibdy, Jibdy, Dibdy</p>
			<p><strong>Year Published: </strong>1990</p>
			<p><strong>Department: </strong>The White House</p>
		</div>
	</div>
	<div class="item-list">
		<hr />
		<img src="https://cdn1.iconfinder.com/data/icons/professional-toolbar-icons-2/64/Under_construction.png" class="large-4 columns">
		<div class="large-8 columns">
			<h4>"He Always Advocated for Justice and Truth": The Mothers of Political Prisoners' Use of Combative Motherhood to Legitimize Human Rights in Kenyan Politics.</h4>
			<p><strong>Author: </strong>Hibdy Dibdy, Gibdy Dibdy, Jibdy, Dibdy</p>
			<p><strong>Year Published: </strong>1990</p>
			<p><strong>Department: </strong>The White House</p>
		</div>
	</div>	
</div>

<?php foreach (loop('items') as $item): ?>
<div class="item hentry">
    <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>
    <div class="item-meta">
    <?php if (metadata('item', 'has files')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>

    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
