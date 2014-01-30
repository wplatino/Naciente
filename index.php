<?php
/**
 * Index
 *
 * Main theme template.
 */
get_template_part( 'static/header' );
?>
<div class="content-loop">
	<?php while (have_posts()) : the_post(); ?>
		<article class="article">
			<div class="date">
				<?php 
					$postDate = get_the_date(); 
					$postDate = explode( ',', $postDate );
					$monthDay = explode( ' ', $postDate[0]);
					$month = substr( $monthDay[0], 0, 3 );
					echo "<p><span class='month-day'>".$month.' '.$monthDay[1]."</span><span class='year'>".$postDate[1]."</span></p>";
				?>
			</div>
			<div class="article-title">
				<h1><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>
			<div class="article-metadata">
				<small>
					<span class="author">
						<?php echo __('Written by','naciente'); ?> <?php the_author( 'nicename' ); ?>
					</span>
					<span class="category">
						&raquo; <?php the_category(' / '); ?>
					</span>
				</small>
			</div>
			<div class="article-content">
				<a href="<?php echo the_permalink(); ?>"><?php the_excerpt(); ?></a>
			</div>
		</article>
	<?php endwhile; /* End loop */ ?>
	<div class="pages">
		<?php kriesi_pagination(); ?>
	</div>
</div>
<?php
get_template_part( 'static/footer' );
?>