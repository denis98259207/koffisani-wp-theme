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
    <div id="primary" class="content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<section class="content not_found">
                            <div class="">
                                        <div class="page_404">
                                            <h1>404</h1>
                                            <p><?php esc_html_e( 'Oops! Cette page ne peut être trouvée.', 'micronium' ); ?></p>
                                            <a class="btn btn-default btn-lg back_home btn-wrap" href="<?= wp_get_referer() ? wp_get_referer() : get_home_url();  ?>"> <i class="fa fa-arrow-left"></i> Retourner à la page précédente ou l'accueil </a>
                                        </div>
                                    </div>
                                </section>
            <p><?php esc_html_e( 'Il semble que rien ne se trouve à cet endroit. Peut-être, faut-il essayer une recherche ?', 'micronium' ); ?></p>
            <?php koffisani_get_search_form();
            ?>
    </div>
<?php get_sidebar(); ?>
<?php
get_footer();
