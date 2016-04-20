</div>
</div>
	<div id="footer">
	    <?php if ( $footerText = get_theme_option('Footer Text') ): ?>
        <p><?php echo $footerText; ?></p>
        <?php endif; ?>
    	<?php fire_plugin_hook('public_footer'); ?>
		<ul class="pagination">
	
		</ul>
		<div class="row">
			<div class="footer-menu large-4 columns">			
				<h4>Lewis & Clark College</h4>
				<p>
					0615 SW Palatine Hill Road <br/>
					Portland, Oregon 97219 USA <br />
				</p>
			</div>
			<div class="footer-menu large-4 columns">
				<h4>Menu</h4>
				<ul class="link-list no-bullet">
					<li><a href="/items/browse">Browse Items</a></li>
					 <li><a href="/collections/browse">Browse Collections</a></li>
					<?php //echo public_nav_main(); ?>
				</ul>
			</div>
			
			<div class="footer-menu large-4 columns">
				<h4>Credits </h4>
				<p>
					Designed By <br />
					<a href="http://library.lclark.edu/">Watzek Library</a><br />
					<a href="mailto:librarian@lclark.edu">librarian@lclark.edu</a><br />
					506-768-7274<br/>
				</p>
			</div>
	</div>
</div>
</div>