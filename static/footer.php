					</div><!-- Content -->
					<div class="footer">
						<p class="text-center">
							<?php echo __("Copyright &copy;") . ' ' . date('Y') . ' ' . get_bloginfo('name'); ?>
						</p>
						<?php wp_nav_menu( array( 'theme_location' => 'menu-foot-1', 'walker' => new naciente_walker() ) ); ?>
					</div>
				</div><!-- Site content -->
			</div><!-- Site surface -->
		</div><!-- Site container -->
		<?php wp_footer(); ?>
		<?php
			if( !is_admin() ) {
		?>
		<script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-47113018-1', '8elite.com');
		  ga('send', 'pageview');
		</script>
		<?php
			}
		?>
	</body>
</html>