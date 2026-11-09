<?php
	get_header();
?>
	<div class="cbo-page page-404">
		<section class="cbo-herosimple">
			<div class="herosimple-inner cbo-container container--nomargin container--padding">

				<div class="herosimple-content">
					<div class="cbo-title-1">
						<h1>
							404 error
						</h1>
					</div>

					<div class="content-chapo cbo-chapo cbo-cms slide-up">
						<p>
							The page you are looking for does not exist.<br />You can always retrace your steps.
						</p>
						<a class="cbo-button slide-up" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							Back home
						</a>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php
	get_footer();
?>