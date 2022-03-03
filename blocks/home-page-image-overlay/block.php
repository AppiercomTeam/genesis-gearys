<?php
	/**
	 * The markup for our "fancy image" custom block in Genesis Framework.
	 */


$large_id = block_value( 'main-image' );
$small_id = block_value( 'small-image' );


?>

<div class="genesis-custom-block block-gearys_image_overlay background-shape-<?php block_field( 'main-colour' ); ?>">
	<div class="background-shape"></div>
	<?php echo wp_get_attachment_image( $large_id, 'genesis-custom-block-large' ); ?>

	<div class="gearys_icon-box">
		<div class="circle animated pulse">
			<i class="<?php block_field( 'icon' ); ?>"></i>
		</div>
	</div>
	<div class="about_img_2">
		<?php echo wp_get_attachment_image( $small_id, 'genesis-custom-block-small' ); ?>

	</div>
</div>


