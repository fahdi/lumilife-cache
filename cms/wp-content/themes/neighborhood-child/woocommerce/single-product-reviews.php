<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php if ( comments_open() ) : ?><div id="reviews"><?php
	
	if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
		
		echo '<div id="comments">';
	
		if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
			$count = $product->get_rating_count();
	
			if ( $count > 0 ) {
	
				$average = $product->get_average_rating();
	
				echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="aggregate-rating">';
	
				echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
	
				echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';
	
				echo '</div>';
	
			} else {
	
				echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';
	
			}
	
		} else {
	
			echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';
	
		}
	
		$title_reply = '';
	
		if ( have_comments() ) :
	
			echo '<ol class="commentlist">';
	
			wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );
	
			echo '</ol>';
	
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'woocommerce' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'woocommerce' ) ); ?></div>
				</div>
			<?php endif;
			
			$add_review_text = '<i class="fa-pencil"></i>' . __( 'Write a review', 'swiftframework' );
			
			echo '<p class="add_review"><a href="#review_form" class="inline sf-roll-button" data-toggle="modal" title="' . __( 'Add Your Review', 'woocommerce' ) . '"><span>' . $add_review_text . '</span><span>' . $add_review_text . '</span></a></p>';
	
			$title_reply = __( 'Add a review', 'woocommerce' );
	
		else :
	
			$title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;';
	
			echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline" data-toggle="modal">submit yours</a>?', 'swiftframework' ).'</p>';
	
		endif;
	
		$commenter = wp_get_current_commenter();
			
		echo '</div><div id="review_form" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="review-modal" aria-hidden="true">';
		
		echo '<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  <h2>'.__("Write a review", "swiftframework").'</h3>
		</div>';
		
		echo '<div class="modal-body">';
	
		$comment_form = array(
			'title_reply' => '',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
			),
			'label_submit' => __( 'Submit Review', 'woocommerce' ),
			'logged_in_as' => '',
			'comment_field' => ''
		);
	
		if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Overall Rating', 'swiftframework' ) .'</label><select name="rating" id="rating">
				<option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option>
				<option value="5">'.__( 'Perfect', 'woocommerce' ).'</option>
				<option value="4">'.__( 'Good', 'woocommerce' ).'</option>
				<option value="3">'.__( 'Average', 'woocommerce' ).'</option>
				<option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option>
				<option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option>
			</select></p>';
	
		}
	
		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);
	
		comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
	
		echo '</div></div>';
	
	} else {
		
		echo '<div id="comments">';
	
		$count = $wpdb->get_var("
			SELECT COUNT(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $post->ID
			AND comment_approved = '1'
			AND meta_value > 0
		");
	
		$rating = $wpdb->get_var("
			SELECT SUM(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $post->ID
			AND comment_approved = '1'
		");
	
		if ( $count > 0 ) :
	
			$average = number_format($rating / $count, 2);
	
			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
	
			echo '<div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div>';
	
			echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';
	
			echo '</div>';
	
		else :
	
			echo '<h2>'.__('Reviews', 'woocommerce').'</h2>';
	
		endif;
	
		$title_reply = '';
	
		if ( have_comments() ) :
	
			echo '<ol class="commentlist">';
	
			wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );
	
			echo '</ol>';
	
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'woocommerce' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'woocommerce' ) ); ?></div>
				</div>
			<?php endif;
	
			echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button">'.__('Add Review', 'woocommerce').'</a></p>';
	
			$title_reply = __('Add a review', 'woocommerce');
	
		else :
	
			$title_reply = __('Be the first to review', 'woocommerce').' &ldquo;'.$post->post_title.'&rdquo;';
	
			echo '<p>'.__('There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'swiftframework').'</p>';
	
		endif;
	
		$commenter = wp_get_current_commenter();
	
		echo '</div><div id="review_form_wrapper"><div id="review_form">';
	
		$comment_form = array(
			'title_reply' => $title_reply,
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
			),
			'label_submit' => __('Submit Review', 'woocommerce'),
			'logged_in_as' => '',
			'comment_field' => ''
		);
	
		if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Rating', 'woocommerce') .'</label><select name="rating" id="rating">
				<option value="">'.__('Rate&hellip;', 'woocommerce').'</option>
				<option value="5">'.__('Perfect', 'woocommerce').'</option>
				<option value="4">'.__('Good', 'woocommerce').'</option>
				<option value="3">'.__('Average', 'woocommerce').'</option>
				<option value="2">'.__('Not that bad', 'woocommerce').'</option>
				<option value="1">'.__('Very Poor', 'woocommerce').'</option>
			</select></p>';
	
		}
	
		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);
	
		comment_form( $comment_form );
	
		echo '</div></div>';
	
	}
?><div class="clear"></div></div>
<?php endif; ?>