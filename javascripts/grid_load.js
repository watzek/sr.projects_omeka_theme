$( document ).ready(function() {
	$('.grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: 160
	});
	// layout Masonry after each image loads
	$grid.imagesLoaded().progress( function() {
		$grid.masonry('layout');
	});
});