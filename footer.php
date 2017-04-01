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
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'koffisani' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'koffisani' ), 'WordPress' ); ?></a>
							<span class="sep"> | </span>
							<?php printf( esc_html__( 'Theme: %1$s with %3$s by %2$s.', 'koffisani' ), 'koffisani', '<a href="http://code.koffisani.ga/" rel="designer">Koffi Sani</a>', "<i class='fa fa-heart'></i>" ); ?>
						</p>
					</div>

					<div class="col-lg-6 ">
                        <div class="footer_social">
                            <ul class="footbot_social">
                                <?php $twtr = get_the_author_meta('twitter');
                                if(isset($twtr)) : ?>
                                <li><a class="twtr" href="https://twitter.com/<?= $twtr ?>" data-placement="top" data-toggle="tooltip" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <?php endif;
                                $fb = get_the_author_meta('facebook');
                                if(isset($fb)) : ?>
                                <li><a class="fb" href="<?= $fb ?>" data-placement="top" data-toggle="tooltip" title="Facbook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <?php endif;
                                $gplus = get_the_author_meta('gplus');
                                if(isset($gplus)) : ?>
                                <li><a class="gplus" href="<?= $gplus ?>" data-placement="top" data-toggle="tooltip" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <?php endif;
                                $ln = get_the_author_meta('linkedin');
                                if(isset($ln)) : ?>
                                <li><a class="linkedin" href="<?= $ln ?>" data-placement="top" data-toggle="tooltip" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"> </i></a></li>
                                <?php endif;
                                $skype = get_the_author_meta('skype');
                                if(isset($skype)) : ?>
                                <li><a class="skype" href="skype:<?= $skype ?>" data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
                                <?php endif; ?>
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
