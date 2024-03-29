<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<aside id="comments" class="block block__comments bg-white">
  <div class="container">
    <div class="row">
      <div class="comments-area col">
        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) :
          ?>
        <h4 class="comments-title">
          <?php
            $ezpzconsultations_comment_count = get_comments_number();
            if ( '1' === $ezpzconsultations_comment_count ) {
              printf(
                /* translators: 1: title. */
                esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'ezpzconsultations' ),
                '<span>' . wp_kses_post( get_the_title() ) . '</span>'
              );
            } else {
              printf( // WPCS: XSS OK.
                /* translators: 1: comment count number, 2: title. */
                esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $ezpzconsultations_comment_count, 'comments title', 'ezpzconsultations' ) ),
                number_format_i18n( $ezpzconsultations_comment_count ),
                '<span>' . wp_kses_post( get_the_title() ) . '</span>'
              );
            }
            ?>
        </h4>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
          <?php
            wp_list_comments( array(
              'style'      => 'ol',
              'short_ping' => true,
            ) );
            ?>
        </ol>

        <?php
          the_comments_navigation();

          // If comments are closed and there are comments, let's leave a little note, shall we?
          if ( ! comments_open() ) :
            ?>
        <div class="callout warning no-comments"><?php esc_html_e( 'Comments are closed.', 'ezpzconsultations' ); ?></div>
        <?php
          endif;

        endif; // Check for have_comments().

        comment_form();
        ?>

      </div>
    </div>
  </div>
</aside>
