<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package koffisani
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 

		if(has_post_thumbnail($id)) : ?>
            <figure class="post_img">
                <?php
                        // Post thumbnail.
                the_post_thumbnail();
                
                        ?>
            </figure>
        <?php endif;

		?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="metaInfo">
			<?php koffisani_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
            <a class="btn btn-small btn-default" href="<?= the_permalink() ?>">Lire plus <i class="fa fa-angle-double-right"></i></a>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
