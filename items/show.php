
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div id="primary">
    <h1><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>
    <h3>By: <?php echo metadata('item', array('Dublin Core','Creator')); ?></h3>

<?php

$collection = get_collection_for_item();

if ($collection->id==27){

        $isPublic= metadata($item, array('Item Type Metadata', 'Public'));

       // echo $isPublic;
        if ($_SESSION["Zend_Auth"]["storage"]){
            $auth=true;
        }
        else{$auth=false;}

 		if ($isPublic!="No" || ($isPublic=="No" && $auth==true)){
 		?>
		  <div class="slider-nav">

			<?php
			set_loop_records('files', get_current_record('item')->Files);
			foreach(loop('files') as $file){
			  echo file_image('square_thumbnail', array('class' => 'thumbnail'), $file);
			}
			?>
		  </div><!-- closing div for slider-nav slider -->
		  <div class="featured-studio-art">

			<?php
			set_loop_records('files', get_current_record('item')->Files);
			foreach(loop('files') as $file){
			  echo '<div class="studio-files">';
				echo file_image('fullsize', array('class' => 'fullsize'), $file);
				echo '<br />';
				$file_metadata = getFileMetadata($file);
				echo $file_metadata;
			  echo '</div>';
			}
			?>
			</div><!-- closing div for featured-studio-art slider -->
			<hr />




 		<?php


 		}
         if ($isPublic=="No" && $auth==false){


            echo "<p><a class='loginLink'>You must sign in to view this content</a>.</p>";
        }





?>

  <?php
}
else{


        $filecount=count($item->Files);

        $nodisplay=array("tif","tiff","jpg","jpeg");

        //var_dump($_SESSION);

        $isPublic= metadata($item, array('Item Type Metadata', 'IsPublic'));

       // echo $isPublic;
        if ($_SESSION["Zend_Auth"]["storage"]){
            $auth=true;
        }
        else{$auth=false;}




        if ($isPublic=="yes" || ($isPublic=="no" && $auth==true)){

            if ($filecount>0){

                $fn=$item->Files[0]->filename;

                $f=explode(".", $fn);
                $ext=strtolower($f[1]);
                if (!in_array($ext, $nodisplay)){
                    echo files_for_item(array('imageSize' => 'fullsize'));
                }

            }




        }

        if ($isPublic=="no" && $auth==false){


            echo "<p><a class='loginLink'>You must sign in to view this document</a>.</p>";
        }
}

?>


    <!-- Items metadata -->
    <div id="item-metadata">
        <p class="item-field">Title</p>
        <p class="item-value"><?php echo metadata('item', array('Dublin Core','Title')); ?></p>
        <div style="clear: both;"></div>

        <p class="item-field">Creator</p>
        <p class="item-value"><?php echo metadata('item', array('Dublin Core','Creator')); ?></p>
        <div style="clear: both;"></div>

        <?php
          $value = metadata('item', array('Dublin Core','Date'));
          if ($value){
        ?>
          <p class="item-field">Date</p>
          <p class="item-value"><?php echo metadata('item', array('Dublin Core','Date')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>

        <?php
          $value = metadata('item', array('Item Type Metadata','Thesis Type'));
          if ($value){
        ?>
          <p class="item-field">Thesis Type</p>
          <p class="item-value"><?php echo metadata('item', array('Item Type Metadata','Thesis Type')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>

        <?php
          $value = metadata('item', array('Item Type Metadata','Year Author Born'));
          if ($value){
        ?>
          <p class="item-field">Year Author Born</p>
          <p class="item-value"><?php echo metadata('item', array('Item Type Metadata','Year Author Born')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>

        <?php if(tag_string('item', $link='items/browse', $delimiter = ', ')){ ?>
          <p class="item-field">Keywords</p>
          <p class="item-value"><?php echo tag_string('item', $link='items/browse', $delimiter = ', '); ?></p>
          <div style="clear: both;"></div>
        <?php } ?>

        <?php
          $value = metadata('item', array('Item Type Metadata','Professor'));
          if ($value){
        ?>
          <p class="item-field">Professor</p>
          <p class="item-value"><?php echo metadata('item', array('Item Type Metadata','Professor')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>



        <?php
          $value = metadata('item', array('Item Type Metadata','Artist Statement'));
          if ($value){
        ?>
          <p class="item-field">Artist Statement</p>
          <p class="item-value" style='margin-left:250px;'><?php echo metadata('item', array('Item Type Metadata','Artist Statement')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>

        <?php
          $value = metadata('item', array('Item Type Metadata','Abstract'));
          if ($value){
        ?>
          <p class="item-field">Abstract</p>
          <p class="item-value" style='margin-left:250px;'><?php echo metadata('item', array('Item Type Metadata','Abstract')); ?></p>
          <div style="clear: both;"></div>
        <?php  } ?>

        <?php
          $collection = get_collection_for_item();
          if ($collection){
        ?>
            <p class="item-field">Department</p>
            <p class="item-value"><a href ="/seniorprojects/items/browse?collection=<?php echo metadata($collection, 'id');?>" ><?php echo metadata($collection, array('Dublin Core','Title'));?></a></p>
            <div style="clear: both;"></div>
        <?php  } ?>

        <p class="item-field">Citation</p>
        <p class="item-value"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></p>
        <div style="clear: both;"></div>




    </div>



    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>

</div> <!-- End of Primary. -->





 <?php echo foot(); ?>
<script type="text/javascript">
            jQuery(document).ready(function($) {
                // We only want these styles applied when javascript is enabled
                $('div.content').css('display', 'block');

                // Initially set opacity on thumbs and add
                // additional styling for hover effect on thumbs
                var onMouseOutOpacity = 0.67;
                jQuery('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
                    mouseOutOpacity:   onMouseOutOpacity,
                    mouseOverOpacity:  1.0,
                    fadeSpeed:         'fast',
                    exemptionSelector: '.selected'
                });

                // Initialize Advanced Galleriffic Gallery
                var gallery = $('#thumbs').galleriffic({
                    delay:                     2500,
                    numThumbs:                 8,
                    preloadAhead:              10,
                    enableTopPager:            false,
                    enableBottomPager:         false,
                    imageContainerSel:         '#slideshow',
                    controlsContainerSel:      '#controls',
                    captionContainerSel:       '#caption',
                    loadingContainerSel:       '#loading',
                    renderSSControls:          true,
                    renderNavControls:         true,
                    playLinkText:              'Play Slideshow',
                    pauseLinkText:             'Pause Slideshow',
                    prevLinkText:              '&lsaquo; Previous Photo',
                    nextLinkText:              'Next Photo &rsaquo;',
                    nextPageLinkText:          'Next &rsaquo;',
                    prevPageLinkText:          '&lsaquo; Prev',
                    enableHistory:             true,
                    autoStart:                 false,
                    syncTransitions:           true,
                    defaultTransitionDuration: 900,
                    onSlideChange:             function(prevIndex, nextIndex) {
                        // 'this' refers to the gallery, which is an extension of $('#thumbs')
                        this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);

                        // Update the photo index display
                        this.$captionContainer.find('div.photo-index')
                            .html('Photo '+ (nextIndex+1) +' of '+ this.data.length);

                            d=$("span.current a img").attr("src");
                            if ($("span.current a img").attr("src")==undefined){

                                e=$("a.thumb:first img").attr("src");
                                d = e.replace("square_thumbnails", "fullsize");
                                console.log(d);
                            }
                            else{
                                d=$("span.current a img").attr("src");
                                console.log(d);
                            }

                            d="/files/fullsize/45ffee09380964962b522d89c0302f1c.jpg";
                            var img = new Image();
                            img.src=d;
                            h=img.height;
                            w=img.width;

                            console.log(img.height);

                    },
                    onPageTransitionOut:       function(callback) {
                        this.fadeTo('fast', 0.0, callback);
                    },
                    onPageTransitionIn:        function() {
                        var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
                        var nextPageLink = this.find('a.next').css('visibility', 'hidden');

                        // Show appropriate next / prev page links
                        if (this.displayedPage > 0)
                            prevPageLink.css('visibility', 'visible');

                        var lastPage = this.getNumPages() - 1;
                        if (this.displayedPage < lastPage)
                            nextPageLink.css('visibility', 'visible');

                        this.fadeTo('fast', 1.0);
                    }
                });

                /**************** Event handlers for custom next / prev page links **********************/

                gallery.find('a.prev').click(function(e) {
                    gallery.previousPage();
                    e.preventDefault();
                });

                gallery.find('a.next').click(function(e) {
                    gallery.nextPage();
                    e.preventDefault();
                });

                /****************************************************************************************/


            });
        </script>



<?php
function getFileMetadata($file){


    $metadata="";

    $title= metadata('file', array('Dublin Core', 'Title'));
    $creator= metadata('file', array('Dublin Core', 'Creator'));
    $date= metadata('file', array('Dublin Core', 'Date'));
    $format= metadata('file', array('Dublin Core', 'Format'));
    $rights=metadata('file', array('Dublin Core', 'License'));
    $workType=metadata('file', array('Dublin Core', 'Type'));
    $medium=metadata('file', array('Dublin Core', 'Medium'));
    $dimension=metadata('file', array('Dublin Core', 'Extent'));

    if (!empty($title)){$metadata.='<p class="item-field">Title</p><p class="item-value">'.$title.'</p><div style="clear: both;"></div>';}
    if (!empty($creator)){$metadata.='<p class="item-field">Creator</p><p class="item-value">'.$creator.'</p><div style="clear: both;"></div>';}
    if (!empty($date)){$metadata.='<p class="item-field">Date</p><p class="item-value">'.$date.'</p><div style="clear: both;"></div>';}
    if (!empty($format)){$metadata.='<p class="item-field">Format</p><p class="item-value">'.$format.'</p><div style="clear: both;"></div>';}
    if (!empty($medium)){$metadata.='<p class="item-field">Medium</p><p class="item-value">'.$medium.'</p><div style="clear: both;"></div>';}
    if (!empty($dimension)){$metadata.='<p class="item-field">Dimensions</p><p class="item-value">'.$dimension.'</p><div style="clear: both;"></div>';}
    if (!empty($workType)){$metadata.='<p class="item-field">Work Type</p><p class="item-value">'.$workType.'</p><div style="clear: both;"></div>';}
    if (!empty($rights)){$metadata.='<p class="item-field">Rights</p><p class="item-value">'.$rights.'</p><div style="clear: both;"></div>';}

    return $metadata;


}




?>
