<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package micronium
 * 
 * @author Koffi Sani <koffisani@gmail.com>
 */

get_header(); ?>

			<section class="content not_found">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12 col-md-12">
                                        <div class="page_404">
                                            <h1>404</h1>
                                            <p><?php esc_html_e( 'Oops! Cette page ne peut être trouvée.', 'micronium' ); ?></p>
                                        </div>
                                    </div>
                                </div>
				<div class="page-content">
					<p><?php esc_html_e( 'Il semble que rien ne se trouve à cet endroit. Peut-être, faut-il essayer une recherche ?', 'micronium' ); ?></p>

					<?php
						//micronium_get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.
						if ( koffisani_categorized_blog() ) :
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'micronium' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						endif;

						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Essayez de chercher dans les archives mensuels. %1$s', 'micronium' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
                            </div><!-- Container -->
			</section><!-- .error-404 -->

		

<?php
get_footer();
