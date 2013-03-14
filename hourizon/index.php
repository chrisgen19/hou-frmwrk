<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hourizon
 * @since Hourizon 1.0
 */

get_header(); ?>

<?php
	
	 
 /* Retrieve the settings and setup query arguments. */
$settings = array(
				'featured_entries' => '3',
				'featured_order' => 'DESC', 
				'featured_slide_group' => '0', 
				'featured_videotitle' => 'true'
				);
				
$settings = woo_get_dynamic_values( $settings );

$query_args = array(
				'limit' => $settings['featured_entries'], 
				'order' => $settings['featured_order'], 
				'term' => $settings['featured_slide_group']
				);

/* Retrieve the slides, based on the query arguments. */
$slides = woo_featured_slider_get_slides( $query_args );
?>

<?php
$count = 0;

	$container_css_class = 'flexslider';

	if ( 'true' == $settings['featured_videotitle'] ) {
		$container_css_class .= ' default-width-slide';
	} else {
		$container_css_class .= ' full-width-slide';
	}
?>

<div id="main-slider">
	<div class="col-full flexslider <?php echo esc_attr( $container_css_class ); ?>">
<ul class="slides slider">
		<?php
			foreach ( $slides as $k => $post ) {
				setup_postdata( $post );
				$count++;

				$url = get_post_meta( get_the_ID(), 'url', true );
				
				$title = get_the_title();
				if ( $url != '' ) {
					$title = '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '">' . $title . '</a>';
				}

				$css_class = 'slide-number-' . esc_attr( $count );

				$slide_media = '';

				$image = woo_image( 'width=523&noheight=true&class=slide-image&link=img&return=true' );
				if ( '' != $image ) {
					$css_class .= ' has-image no-video';
					$slide_media = $image;
				} else {
					$css_class .= ' no-image';
				}
				
		?>
				<li class="slide <?php echo esc_attr( $css_class ); ?>">
					<?php
						if ( '' != $slide_media ) {
							echo '<div class="slide-media">' . $slide_media . '</div><!--/.slide-media-->' . "\n";
						}
					?>
					<div class="slide-content">
						<header><h1><?php echo $title; ?></h1></header>
						<div class="entry"><?php the_content(); ?></div><!--/.entry-->
					</div><!--/.slide-content-->
				</li>
		<?php } wp_reset_postdata(); ?>
		</ul>
	</div><!--/.col-full-->
</div><!--/#featured-slider-->

<div style="clear:both;" ></div>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php hourizon_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php hourizon_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>