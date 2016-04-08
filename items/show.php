
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div id="primary">
    <h1><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

<style>
.gallerythumb{



    
}
.slideshow .image-wrapper a img{width: 500px;}
ul.thumbs li a img {
    width: 90px;
    height: 90px;

}
</style>

<?php

$collection = get_collection_for_item();


if ($collection->id==27){

    


         set_loop_records('files', get_current_record('item')->Files);
?>
                <div class="navigation-container">
                    <div id="thumbs" class="navigation">
                        <a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
                    
                        <ul class="thumbs noscript">
<?php
            foreach(loop('files') as $file){
                $f=$file->filename;
                $title= metadata('file', array('Dublin Core', 'Title'));
                $metadata=getFileMetadata($file);   

?>
                        <li>
                                <a class="thumb " name="" href="/files/fullsize/<?=$f ?>" title="<?= $title?>">
                                    
                                <?php echo file_image('square_thumbnail', array('class' => 'thumbnail'), $file); ?>
                                </a>
                                <div class="caption">
                                    <div class="image-title"><?= $title ?></div>
                                    <div class="image-desc">
                                    
                                        <?= $metadata?>
                                    

                                    
                                    
                                    
                                    
                                    </div>
                                    
                                    <!--
                                    <div class="download">
                                        <a href="http://farm4.static.flickr.com/3261/2538183196_8baf9a8015_b.jpg">Download Originalzzz</a>
                                    </div>
                                    -->
                                </div>
                            </li>
<?php


                


            }
            
            

?>
</ul>
                        <a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
                    </div>
                </div>
                <div class="content">
                    <div class="slideshow-container">
                        <div id="controls" class="controls"></div>
                        <div id="loading" class="loader"></div>
                        <div id="slideshow" class="slideshow"></div>
                    </div>
                    <div id="caption" class="caption-container">
                        <div class="photo-index"></div>
                    </div>
                </div>
                <!-- End Gallery Html Containers -->
        

<?php
}  /* end if coll==27 */
else{


        $filecount=count($item->Files);
        
        $nodisplay=array("tif","tiff","jpg","jpeg");
        
        //var_dump($_SESSION);
        
        $isPublic= metadata($item, array('Item Type Metadata', 'IsPublic'));
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
        
        
            echo "<p>You must sign in to view this document.</p>";
        }
}



?>


    <!-- Items metadata -->
    <div id="item-metadata">
        <?php echo all_element_texts('item'); ?>
    </div>
<!--
    <h3><?php echo __('Files'); ?></h3>
    <div id="item-images">
         <?php echo files_for_item(); ?>
         
         <?php
         /*
         set_loop_records('files', get_current_record('item')->Files);

            foreach(loop('files') as $file)
                
                echo metadata('file', array('Dublin Core', 'Title'));
         
         */
         ?>
         
         
    </div>-->

   <?php if(metadata('item','Collection Name')): ?>
      <div id="collection" class="element">
        <h3><?php echo __('Collection'); ?></h3>
        <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
      </div>
   <?php endif; ?>

     <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item','has tags')): ?>
    <div id="item-tags" class="element">
        <h3><?php echo __('Tags'); ?></h3>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
    </div>
       <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>


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
                $('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
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
    
    $creator= metadata('file', array('Dublin Core', 'Creator'));
    $date= metadata('file', array('Dublin Core', 'Date'));
    $format= metadata('file', array('Dublin Core', 'Format'));
    //$dimensions=metadata('file', array('Dublin Core', 'Extent'));
    $rights=metadata('file', array('Dublin Core', 'License'));
    $workType=metadata('file', array('Dublin Core', 'Type'));
    $view=metadata('file', array('Dublin Core', 'Spatial Coverage'));
    $medium=metadata('file', array('Dublin Core', 'Medium'));
    
    if (!empty($creator)){$metadata.="<div class='gallerymd'><label>Creator</label> $creator</div>";}
    if (!empty($date)){$metadata.="<div class='gallerymd'><label>Date</label> $date</div>";}
    if (!empty($format)){$metadata.="<div class='gallerymd'><label>Format</label> $format</div>";}
    if (!empty($medium)){$metadata.="<div class='gallerymd'><label>Medium</label> $medium</div>";}
    if (!empty($workType)){$metadata.="<div class='gallerymd'><label>WorkType</label> $workType</div>";}
    if (!empty($view)){$metadata.="<div class='gallerymd'><label>View</label> $view</div>";}
    if (!empty($rights)){$metadata.="<div class='gallerymd'><label>Rights</label> $rights</div>";}
    
    return $metadata;   


}




?>      