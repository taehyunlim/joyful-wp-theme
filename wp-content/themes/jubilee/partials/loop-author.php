<?php
/**
 * Author Box
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Do not show again at bottom if already shown at top
// This relates to author archives
if ( ! empty( $GLOBALS['jubilee_author_box_shown'] ) ) {
	return;
} else {
	$GLOBALS['jubilee_author_box_shown'] = true;
}

// Show only on single blog posts and list of author's posts
if ( ! is_singular( 'post' ) && ! is_author() ) return;

// Show only if have profile bio
if ( ! get_the_author_meta( 'description' ) ) return;

// Show button?
// Not on author archive and has more than this post
$show_button = is_singular() && get_the_author_posts() > 1 ? true : false;

?>

<aside class="jubilee-author-box jubilee-centered-medium jubilee-entry-content<?php if ( $show_button ) : ?> jubilee-author-box-show-button<?php endif; ?>">

	<div class="jubilee-author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 216 ); // 108x108 so 216 for hiDPI/Retina ?>
	</div>

	<div class="jubilee-author-content">

		<header>

			<h2 class="jubilee-h3"><?php echo esc_html( wptexturize( get_the_author() ) ); ?></h2>

			<?php if ( $show_button ) : ?>

				<div class="jubilee-author-box-archive">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="jubilee-button jubilee-button-secondary"><?php printf( __( 'More Posts', 'jubilee' ), get_the_author() ); ?></a>
				</div>

			<?php endif; ?>

		</header>

		<div class="jubilee-author-bio">

			<?php echo wpautop( wptexturize( get_the_author_meta( 'description' ) ) ); ?>

		</div>

	</div>

</aside>
