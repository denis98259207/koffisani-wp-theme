<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package koffisani
 */

?>

			</div><!-- .container -->
		</div> <!-- .row -->
	</div> <!-- #content-->

	<footer id="colophon" class="site-footer footer" role="contentinfo">
            <section class="footer_bottom site-info">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="copyright">
                                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'koffisani' ) ); ?>"><?php /* translator : %s:  */
                                printf( esc_html__( 'Proudly powered by %s', 'koffisani' ), 'WordPress' ); ?></a>
                                <span class="sep"> | </span>
                                <?php /* translator : %1$s %2$s */
                                printf( esc_html__( 'Theme: %1$s with %3$s by %2$s.', 'koffisani' ), '<a href="https://github.com/koffisani/koffisani-wp-theme" >koffisani</a>', '<a href="http://code.koffisani.ga/" rel="designer">Koffi Sani</a>', "<i class='fa fa-heart'></i>" ); ?>
                            </p>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="footer_social">
                                <ul class="footbot_social">
                                    <?php $twtr = get_option ('twitter_username');
                                    if(isset ($twtr) && !empty ($twtr)) : ?>
                                    <li><a class="twtr" href="https://twitter.com/<?= $twtr ?>" data-placement="top" data-toggle="tooltip" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <?php endif;
                                    $gh = get_option ('github_username');
                                    if(isset ($gh) && !empty ($gh)) : ?>
                                    <li><a class="gh" href="https://github.com/<?= $gh ?>" data-placement="top" data-toggle="tooltip" title="Github" target="_blank"><i class="fa fa-github"></i></a></li>
                                    <?php endif;
                                    $gl = get_option('gitlab_username');
                                    if(isset ($gl) && !empty ($gl)) : ?>
                                    <li><a class="gl" href="https://gitlab.com/<?php echo $gl ?>" data-placement="top" data-toggle="tooltip" title="Gitlab" target="_blank"><i class="fa fa-gitlab"></i></a></li>
                                    <?php endif;
                                    $fb = get_option ('facebook_url');
                                    if(isset ($fb) && !empty ($fb)) : ?>
                                    <li><a class="fb" href="<?= $fb ?>" data-placement="top" data-toggle="tooltip" title="Facbook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <?php endif;
                                    $gplus = get_option ('gplus_url');
                                    if(isset ($gplus) && !empty ($gplus)) : ?>
                                    <li><a class="gplus" href="<?php echo $gplus ?>" data-placement="top" data-toggle="tooltip" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <?php endif;
                                    $ln = get_option ('linkedin_url');
                                    if(isset ($ln) && !empty ($ln)) : ?>
                                    <li><a class="linkedin" href="<?php echo $ln ?>" data-placement="top" data-toggle="tooltip" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"> </i></a></li>
                                    <?php endif;
                                    $skype = get_option ('skype');
                                    if(isset ($skype) && !empty ($skype)) : ?>
                                    <li><a class="skype" href="skype:<?php echo $skype ?>" data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
                                    <?php endif; ?>
                                    <li><a class="rss" href="<?= bloginfo ('rss_url') ?>" data-plaecment='top' data-toggle='tooltip' title="Flux RSS"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
