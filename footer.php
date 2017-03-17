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
							<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'koffisani' ), 'koffisani', '<a href="https://automattic.com/" rel="designer">Koffi Sani</a>' ); ?>
						</p>
					</div>

					<div class="col-lg-6 ">
                        <div class="footer_social">
                            <ul class="footbot_social">
                                <li><a class="twtr" href="https://twitter.com/micronium_gabon" data-placement="top" data-toggle="tooltip" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="fb" href="https://www.facebook.com/micronium.gabon" data-placement="top" data-toggle="tooltip" title="Facbook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="gplus" href="https://plus.google.com/+MicroniumNet2016" data-placement="top" data-toggle="tooltip" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="linkedin" href="https://www.linkedin.com/company/micronium-gabon" data-placement="top" data-toggle="tooltip" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"> </i></a></li>
                                <li><a class="skype" href="skype:live:contact_48275" data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
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
