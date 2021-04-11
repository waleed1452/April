<?php
/**
 * The template for displaying comments.php
 *
 * @package WordPress
 * @subpackage april
 * @since april 1.0
 */
if (post_password_required()) {
	return;
}
?>
<div id="comments" class="gf-comments-area clearfix">
    <?php if (have_comments()) : ?>
        <div class="comments-list clearfix">
            <h4 class="gf-heading-title"><span><?php comments_number(esc_html__('No Comments', 'g5plus-april'), esc_html__('One Comment', 'g5plus-april'), esc_html__('Comments (%)', 'g5plus-april')) ?></span></h4>
            <ol class="comment-list clearfix">
                <?php wp_list_comments(g5Theme()->blog()->get_list_comments_args()); ?>
            </ol>
            <?php if (get_comment_pages_count() > 1): ?>
                <nav class="comment-navigation blog-pagination clearfix mg-top-20">
                    <?php $paginate_comments_args = array(
                        'prev_text' => wp_kses_post(__('<i class="fa fa-angle-left"></i> Previous','g5plus-april')) ,
                        'next_text' => wp_kses_post(__('Next <i class="fa fa-angle-right"></i>','g5plus-april')),
                    );
                    paginate_comments_links($paginate_comments_args);
                    ?>
                </nav>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php comment_form(g5Theme()->blog()->get_comments_form_args()); ?>
</div>
