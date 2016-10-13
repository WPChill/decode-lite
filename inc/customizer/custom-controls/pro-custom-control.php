<?php

add_action( 'customize_register', 'register_decode_lite_upsell_control' );

if ( ! function_exists( 'register_decode_lite_upsell_control' ) ) {
	function register_decode_lite_upsell_control() {

		/**
		 * Class used to render "PRO panels"
		 */
		if ( ! class_exists( 'Decode_Lite_Upsell_Render_Panel' ) ) {

			class Decode_Lite_Upsell_Render_Panel extends WP_Customize_Control {

				public function render_content() {

					if ( $this->choices ) {

						echo '<div>';

						foreach ( $this->choices as $key => $value ) {

							switch ( $key ) {
								case 'title':
									echo '<h2>' . esc_attr( $value ) . '</h2>';
									echo '<hr />';
									break;

								case 'list_items':
									if ( is_array( $value ) && ! empty( $value ) ) {
										echo '<ul>';
										foreach ( $value as $list_item_key => $list_item ) {
											echo '<li>' . $list_item . '</li>';
										}
										echo '</ul>';
										echo '<hr />';
									}
									break;

								case 'description':
									echo '<div class="pro-version-text">' . esc_attr( $value ) . '</div>';
									echo '<hr />';
									break;


								case 'show_pro_button':
									if ( $value == true ) {
										echo '<div class="decode-one-half">';
										echo '<a href="https://www.machothemes.com/themes/decode-pro/" target="_blank" class="button button-primary decode-lite-upgrade">' . __( 'Get Pro', 'decode' ) . '</a>';
										echo '</div><!--/.decode-one-half-->';
									}
									break;

								case 'show_demo_button':
									if ( $value == true ) {
										echo '<div class="decode-one-half">';
										echo '<a href="http://www.machothemes.com/demo/#Decode PRO" target="_blank" class="button button-secondary decode-lite-upgrade">' . __( 'See live demo', 'decode' ) . '</a>';
										echo '</div><!--/.decode-one-half-->';
									}
									break;

							}

						} // foreach

						echo '</div><!--/.text-center-->';

					} // $this->choices
				} // function
			} // class
		} // class exists
	}
}
