<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">

		<?php
			if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'underwritten' ) ) :
				newspack_sponsored_underwriters_info( get_the_id(), 'underwritten' );
			endif;
		?>

		<!-- IS SUBSCRIBED TO SITE (ACTIVE SUBSCRIPTION IS AVAILABLE) -->
		<?php if ( newspack_is_amp() ) : ?>
			<section amp-access="isSubscribedToSite" amp-access-hide>
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'newspack' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'newspack' ),
						'after'  => '</div>',
					)
				);

				if ( is_active_sidebar( 'article-2' ) && is_single() ) {
					dynamic_sidebar( 'article-2' );
				}
				?>
			</section>

			<section amp-access="NOT isSubscribedToSite" amp-access-hide>
				<?php the_excerpt(); ?>
				<p>You do not have an active subscription. Please subscribe or login. <a>Subscribe</a> | <a on="tap:amp-access.login-sign-in">Login</a></p>
			</section>
		<?php else : ?>
			<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'newspack' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'newspack' ),
						'after'  => '</div>',
					)
				);

				if ( is_active_sidebar( 'article-2' ) && is_single() ) {
					dynamic_sidebar( 'article-2' );
				}
				?>
			<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php newspack_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
	if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native' ) ) :
		newspack_sponsor_footer_bio( get_the_id() );
	elseif ( ! is_singular( 'attachment' ) ) :
		get_template_part( 'template-parts/post/author', 'bio' );
	endif;
	?>

</article><!-- #post-${ID} -->
