<?php

if(!defined('ABSPATH')){
  die(); // no direct access
}

if( !defined( 'Macho_Pro_Version_URL' ) ) {
    define( 'Macho_Pro_Version_URL', 'https://www.machothemes.com/themes/decode-pro/' );
}

if ( !class_exists('WP_Customize_Control') ) {
  return null;
}

/**
 * Customize for disabled HTML elements, extend the WP customizer
 *
 * @since Macho 1.32
 */
if( !class_exists('Macho_Disabled_Custom_Control') ) {
    class Macho_Disabled_Custom_Control extends WP_Customize_Control
    {

        public function render_content()
        {

	         switch($this->type) {

		        case 'textarea':
		         echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		         ?>
		           <label>
		                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		                  <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?> disabled >
		                    <?php echo esc_textarea($this->value()); ?>
		                  </textarea>
		            </label>
		         <?php echo '</div><!--/pro-feature-->';
		        break;

		        case 'text':
		          echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		        ?>
                 <label>
		                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		                  <input type="text" value="<?php echo esc_html( $this->value() ); ?>" class="large-text" <?php $this->link(); ?> disabled >
		            </label>


		        <?php echo '</div><!--/pro-feature-->';
		        break;

		         case 'checkbox':
		          echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		        ?>
                 <label>
                                <input type="checkbox" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
		                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

		            </label>


		        <?php echo '</div><!--/pro-feature-->';
                break;
                case 'radio' : 
                    echo '<div class="checkbox-pro-feature">';
                    echo '<span class="pro-badge">PRO</span>';
                    echo '<span class="customize-control-title">'.$this->label.'</span>';
                    foreach ($this->choices as $key => $value) {
                        echo '<label><input type="radio" value="" disabled>'.$value.'</label>';
                    }

                    echo '</div><!--/pro-feature-->';
		        break;
	        } // end SWITCH statement
        }
    }
}

/**
 * Customize for Numbers, extend the WP customizer
 *
 *@since Macho 1.0.0
 */
if( !class_exists( 'Macho_Number_Custom_Control' ) ) {
    class Macho_Number_Custom_Control extends WP_Customize_Control
    {

        public $type = 'number';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <input type="number" <?php $this->link(); ?> value="<?php echo intval($this->value()); ?>"/>
            </label>
            <?php
        }
    }
}


/**
 * Customize for Contact Form 7, extend the WP Customizer
 *
 * adds a custom control for rendering created contact forms in the customizer.
 * @since Macho 1.0.0
 */
if(!class_exists('Macho_CF7_Custom_Control')) {
    class Macho_CF7_Custom_Control extends WP_Customize_Control
    {

    /**
     * Returns true / false if the plugin: Contact Form 7 is activated;
     *
     * This right here disables the control for selecting a contact form IF the plugin isn\'t active
     *
     * @since Macho 1.15
     *
    * @return bool
     */
    public function active_callback( ) {

        require_once ABSPATH . 'wp-admin/includes/plugin.php';

        if( is_plugin_active('contact-form-7/wp-contact-form-7.php') ) {
            return true;
        } else {
            return false;
        }
    }

        public function Macho_get_cf7_forms()
        {

            global $wpdb;

            // no more php warnings
            $contact_forms = array();

            // check if CF7 is activated
            if ( $this->active_callback()) {
                $cf7 = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form' ");
                if ($cf7) {

                    foreach ($cf7 as $cform) {
                        $contact_forms[$cform->ID] = $cform->post_title;
                    }
                } else {
                    $contact_forms[0] = __('No contact forms found', 'decode');
                }
            }
            return $contact_forms;
        }

        public function render_content()
        {
            $Macho_contact_forms = $this->Macho_get_cf7_forms();

            if (!empty($Macho_contact_forms) ) { ?>

                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <select <?php $this->link(); ?> style="width:100%;">

                <?php echo '<option selected="selected" value="default">'.__('Select your contact form', 'decode').'</option>';

                foreach ($Macho_contact_forms as $form_id => $form_title) {
                    echo '<option value="' . sanitize_key( $form_id ). '" >' . esc_html( $form_title ). '</option>';
                }

                echo '</select>';
            }
        }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Macho 1.0.0
 */
if( !class_exists( 'Macho_General_Pro_Field' ) ) {
    class Macho_General_Pro_Field extends WP_Customize_Control
    {
        public function render_content()
        { ?>

            <div class="pro-version">
                <?php echo $this->label; ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url(Macho_Pro_Version_URL);?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','decode' ); ?></a>
            </div>

       <?php }
    }
}


/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Macho 1.0.8
 */
if( !class_exists( 'Macho_WP_Pro_Customize_Control' ) ) {
    class Macho_WP_Pro_Customize_Control extends WP_Customize_Control {

        public $type = 'new_menu';

        //Render the control's content.
        public function render_content() {
            ?>
            <div class="pro-box">
                <a href="<?php echo esc_url(Macho_Pro_Version_URL);?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','decode' ); ?></a>
            </div>
            <?php
        }
    }
}
