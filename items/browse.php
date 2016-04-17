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

<style>
    .item-box{
        padding: 0 0 0 0;
        margin: 0 0 20px 10px;
        width: 300px;
    }
    .item-box:nth-child(odd){ background:gray; }
    .item-box:nth-child(even){ background:darkgray; }
    .item-box img{
        width: 100%;
        height: 250px;
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }
    .item-box hr{
        margin-top: 10px;
        margin-bottom: 10px
    }
    .item-title{
        color: #fff;
    }
    .item-mdata{
        color: #fff;
        padding: 3px 3px 5px 10px;
        margin: 0 0 0 0;
    }
    .custom-box{
    	width: 300px;
    	border: 2px solid black;
        margin: 0 10px 20px 00px;
      	background-color: gray;
        float: left;
    }
    .custom-box p, h3{
        padding: 3px 3px 5px 10px;
    }
    .custom-box img{
        width: 100%;
        height: 250px;
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }
</style>

<div class="container">
	<div class="custom-box">
		<img src="http://i.stack.imgur.com/W08Uq.png"/>
		<h3>Title</h3>
        <hr />
        <p><strong>Author: </strong> Hibdy Dibdy</p>
        <p><strong>Department: </strong> White House</p>
        <p><strong>Year: </strong>2020</p>
	</div>
	<div class="custom-box">
		<img src="http://i.stack.imgur.com/W08Uq.png"/>
		<h3>"I'd rather cry in a BMW than laugh on the backseat of a bicycle": How Only Children Confront Issues of Re-traditionalization While Maintaining their Individuality</h3>
        <hr />
        <p><strong>Author: </strong> Hibdy Dibdy, Gibdy Dibdy, Zibdy Dibdy, Fibdy Dibdy, Kibdy Dibdy</p>
        <p><strong>Department: </strong> White House</p>
        <p><strong>Year: </strong>2020</p>
	</div>
	<div class="custom-box">
		<img src="http://i.stack.imgur.com/W08Uq.png"/>
		<h3>Title</h3>
        <hr />
        <p><strong>Author: </strong> Hibdy Dibdy</p>
        <p><strong>Department: </strong> White House</p>
        <p><strong>Year: </strong>2020</p>
	</div>
	<div class="custom-box">
		<img src="http://i.stack.imgur.com/W08Uq.png"/>
		<h3>Title</h3>
        <hr />
        <p><strong>Author: </strong> Hibdy Dibdy</p>
        <p><strong>Department: </strong> White House</p>
        <p><strong>Year: </strong>2020</p>
	</div>
</div>

<!-- <div class="container">
    <div class="row items-browse">
        <div class="small-4 columns item-box">
            <img src="../images/preview.png"/>
            <h3 class="item-title text-center">Title</h3>
            <hr />
            <p class="item-mdata"><strong>Author: </strong> Hibdy Dibdy</p>
            <p class="item-mdata"><strong>Department: </strong> White House</p>
            <p class="item-mdata"><strong>Year: </strong>2020</p>
        </div>
        <div class="small-4 columns item-box">
            <img src="../images/preview.png"/>
            <h4 class="item-title text-center">"I'd rather cry in a BMW than laugh on the backseat of a bicycle": How Only Children Confront Issues of Re-traditionalization While Maintaining their Individuality</h4>
            <hr />
            <p class="item-mdata"><strong>Author: </strong> Hibdy Dibdy, Gibdy Dibdy, Zibdy Dibdy, Fibdy Dibdy, Kibdy Dibdy</p>
            <p class="item-mdata"><strong>Department: </strong> White House</p>
            <p class="item-mdata"><strong>Year: </strong>2020</p>
        </div>
        <div class="small-4 columns item-box end">
            <img src="../images/preview.png"/>
            <h3 class="item-title text-center">Title</h3>
            <hr />
            <p class="item-mdata"><strong>Author: </strong> Hibdy Dibdy</p>
            <p class="item-mdata"><strong>Department: </strong> White House</p>
            <p class="item-mdata"><strong>Year: </strong>2020</p>
        </div>
    </div>
</div> -->

<?php endif; ?>

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
