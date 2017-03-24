<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing div elements.
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */
$hide_preloader = get_option( 'bonno_hide_preloader', 0 );
?>
			<div class="fpadding cf"></div>

		</div>
		<!-- /.wrapper -->

		<!-- FOOTER -->
		<footer class="footer">

			<div class="section">
				<div class="col span_5_of_12 auto">
					<?php echo do_shortcode( get_option( 'bonno_footer_text' ) );?>
				</div>
			</div>

		</footer>
		<!-- /.footer -->

		<?php if ( !$hide_preloader ) { ?>
			<!-- Preloader -->
			<div id="preloader"><div id="status">&nbsp;</div></div>
		<?php } ?>
		<script>
			// (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			// (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			// m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			// })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			// ga('create', 'UA-46302488-9', 'auto');
			// ga('send', 'pageview');
		</script>
		<?php wp_footer(); ?>
	</body>
</html>
