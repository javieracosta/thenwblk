<?php
/**
 * plugin settings class for products-database plugin
 *
 * this uses the generic plugin settings class to build the settings specific to
 * the plugin
 */
class PDb_Settings extends Plugin_Settings {

  function __construct() {

    $this->WP_setting = Products_Db::$products_db_options ;

    // define the settings sections
    // no need to worry about the namespace, it will be prefixed
    $this->sections = array(
                            'main' => __('General Settings', Products_Db::PLUGIN_NAME ),
                            'signup' => __('Signup Form Settings', Products_Db::PLUGIN_NAME ),
                            'record' => __('Record Form Settings', Products_Db::PLUGIN_NAME ),
                            );


    // run the parent class initialization to finish setting up the class 
    parent::__construct( __CLASS__, $this->WP_setting, $this->sections );

    $this->submit_button = __('Save Plugin Settings', Products_Db::PLUGIN_NAME );
    
    // define the individual settings
    $this->_define_settings();

    // now that the settings have been defined, finish setting
    // up the plugin settings
    $this->initialize();

  }

  /**
   * defines the individual settings for the plugin
   *
   * @return null
   */
  private function _define_settings() {

    // general settings

    $this->plugin_settings[] = array(
        'name'       =>'list_limit',
        'title'      => __('Records per Page', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    =>array(
          'type'        =>'text',
          'help_text'   => __('the number of records to show on each page', Products_Db::PLUGIN_NAME ),
          'attributes'  =>array( 'style'=>'width:40px' ),
          'value'       =>10,
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'unique_email',
        'title'      => __('Don&#39;t Allow Duplicate Email Addresses', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('if someone registers with an email address that already exists, update the existing record, don&#39;t create a new one.', Products_Db::PLUGIN_NAME ),
          'value'       => 1,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'show_pid',
        'title'      =>__('Show the Private ID in List', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('whether to show the private ID in the product list in the admin', Products_Db::PLUGIN_NAME ),
          'value'       => 1,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'empty_field_message',
        'title'      =>__('Missing Field Error Message', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    =>array(
          'type'       =>'text',
          'help_text'  => __('the message shown when a field is required, but left empty (the %s is replaced by the name of the field)', Products_Db::PLUGIN_NAME ),
          'value'      => __('The %s field is required.', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'invalid_field_message',
        'title'      =>__('Invalid Field Error Message', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    =>array(
          'type'       =>'text',
          'help_text'  => __("the message shown when a field's value does not pass the validation test", Products_Db::PLUGIN_NAME ),
          'value'      => __('The %s field appears to be incorrect.', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'field_error_style',
        'title'      =>__('Field Error Style', Products_Db::PLUGIN_NAME ),
        'group'      => 'main',
        'options'    =>array(
          'type'        =>'text',
          'help_text'   => __('the CSS style applied to an input or text field that is missing or has not passed validation', Products_Db::PLUGIN_NAME ),
          'value'       => __('border: 1px solid red', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'image_upload_location',
        'title'      => __('File Upload Location', Products_Db::PLUGIN_NAME ),
        'group'      => 'main',
        'options'    =>array(
          'type'        => 'text',
          'help_text'   => __("this defines where the uploaded files will go, relative to the WordPress root.<br />Don't put it in the plugin folder, the images and files could get deleted when the plugin is updated.", Products_Db::PLUGIN_NAME ),
          'value'       => Products_Db::$uploads_path,
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'image_upload_limit',
        'title'      =>__('Image Upload Limit', Products_Db::PLUGIN_NAME ),
        'group'      => 'main',
        'options'    =>array(
          'type'        =>'dropdown',
          'help_text'   => __('the maximum allowed file size for an uploaded image', Products_Db::PLUGIN_NAME ),
          'value'       => '100K',
					'options'     => array( '10K'=>10,'20K'=>20,'50K'=>50,'100K'=>100,'150K'=>150,'250K'=>250,'500K'=>500, '2MB'=>2048 ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'record_edit_capability',
        'title'      =>__('Record Edit Access Level', Products_Db::PLUGIN_NAME ),
        'group'      => 'main',
        'options'    =>array(
          'type'        =>'dropdown',
          'help_text'   => __('sets the user access level for adding, editing and listing records. (fields management and plugin settings always require admin level access)', Products_Db::PLUGIN_NAME ),
          'value'       => 'edit_others_posts',
					'options'     => array( 'Author'=>'edit_posts','Editor'=>'edit_others_posts','Admin'=>'manage_options' ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'make_links',
        'title'      =>__('Make Links Clickable', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('if a "text-line" field looks like a link (begins with "http" or is an email address) make it clickable', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          ),
        );
		
    $this->plugin_settings[] = array(
        'name'       =>'single_record_page',
        'title'      =>__('Single Record Page', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    =>array
          (
          'type'       =>'dropdown',
          'help_text'  => __('this is the page where the [pdb_single] shortcode is located.', Products_Db::PLUGIN_NAME ),
          'options'    => $this->_get_pagelist(),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'single_record_link_field',
        'title'      =>__('Single Record Link Field', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    =>array
          (
          'type'       =>'dropdown',
          'help_text'  => __('select the field on which to put a link to the single record. Leave blank or set to "none" for no link.', Products_Db::PLUGIN_NAME ),
          'options'    => $this->_get_display_columns(),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'mark_required_fields',
        'title'      =>__('Mark Required Fields', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('mark the title of required fields?', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'required_field_marker',
        'title'      =>__('Required Field Marker', Products_Db::PLUGIN_NAME ),
        'group'      => 'main',
        'options'    =>array(
          'type'       => 'text-field',
          'help_text'  => __('html added to field title for required fields if selected above (the %s is replaced by the name of the field)', Products_Db::PLUGIN_NAME ),
          'value'      => '%s<span class="reqd">*</span>',
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'rich_text_editor',
        'title'      =>__('Use Rich Text Editor', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('enable the rich text editor on textarea fields (works only for logged-in WP users)', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'html_email',
        'title'      =>__('Send HTML Email', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('use rich text in plugin emails? If you turn this off, be sure to remove all HTML tags from the email body settings for the plugin.', Products_Db::PLUGIN_NAME ),
          'value'       => 1,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'strict_dates',
        'title'      =>__('Strict Date Format', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('This forces date inputs to be interpreted strictly according to the date format setting of the site. You should tell your users what format you are expecting them to use. This also applies to date values used in [pdb_list] shortcode filters. The date with your setting looks like this: "'.date(get_option('date_format')).'"', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          ),
        );

    $this->plugin_settings[] = array(
        'name'       =>'strict_search',
        'title'      =>__('Strict User Searching', Products_Db::PLUGIN_NAME ),
        'group'      =>'main',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('When checked, the frontend list search must match the whole field exactly. If unchecked, the search will match if the search term is found in part of the field. Searches are not case-sensitive either way.', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          ),
        );


    // signup form settings

    $this->plugin_settings[] = array(
        'name'       =>'signup_button_text',
        'title'      =>__('Signup Button Text', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('text shown on the button to sign up', Products_Db::PLUGIN_NAME ),
          'value'       => _x('Sign Up','the text on a button to submit a signup form', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'signup_thanks_page',
        'title'      =>__('Signup Thanks Page', Products_Db::PLUGIN_NAME ),
        'group'      =>'signup',
        'options'    =>array
					(
          'type'       =>'dropdown',
          'help_text'  => __('after they singup, send them to this page for a thank you message. This page is where you put the [pdb_signup_thanks] shortcode, but you don&#39;t have to do that if you have them go back to the same page.', Products_Db::PLUGIN_NAME ),
					'options'    => $this->_get_pagelist(),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'send_signup_receipt_email',
        'title'      => __('Send Signup Response Email', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('Send a receipt email to people who sign up', Products_Db::PLUGIN_NAME ),
          'value'       => 1,
          'options'     => array( 1, 0 ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'receipt_from_address',
        'title'      =>__('Signup Email From Address', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('the "From" address on signup receipt emails. If the recipient hits "reply", their reply will go to this address', Products_Db::PLUGIN_NAME ),
          'value'       => get_bloginfo( 'admin_email' ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'receipt_from_name',
        'title'      =>__('Signup Email From Name', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('the "From" name on signup receipt emails.', Products_Db::PLUGIN_NAME ),
          'value'       => get_bloginfo( 'name' ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'signup_receipt_email_subject',
        'title'      =>__('Signup Response Email Subject', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('subject line for the signup response email', Products_Db::PLUGIN_NAME ),
          'value'       => sprintf( __("You've just signed up on %s", Products_Db::PLUGIN_NAME ), get_bloginfo('name') ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'signup_receipt_email_body',
        'title'      =>__('Signup Response Email', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text-field',
          'help_text'   => __('Body of the email a visitor gets when they sign up. It includes a link ([record_link]) back to their record so they can fill it out. Can include HTML, placeholders:[first_name],[last_name],[email],[record_link].', Products_Db::PLUGIN_NAME ),
					/* translators: the %s will be the name of the website */
          'value'       =>sprintf( __('<p>Thank you, [first_name] for signing up with %s.</p><p>You may complete your registration with additional information or update your information by visiting this link at any time: <a href="[record_link]">[record_link]</a>.</p>', Products_Db::PLUGIN_NAME ),get_bloginfo('name') ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'signup_thanks',
        'title'      =>__('Signup Thanks Message', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text-field',
          'help_text'   => __('Note to display on the web page after someone has submitted a signup form. Can include HTML, placeholders:[first_name],[last_name],[email], etc. They must be fields that are present in the signup form.', Products_Db::PLUGIN_NAME ),
          'value'       =>__('<p>Thank you, [first_name] for signing up!</p><p>You will receive an email acknowledgement shortly. You may complete your registration with additional information or update your information by visiting the link provided in the email.</p>', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'send_signup_notify_email',
        'title'      => __('Send Signup Notification Email', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('Send an email notification that a signup has occurred.', Products_Db::PLUGIN_NAME ),
          'value'       => 1,
          'options'     => array( 1, 0 ),
          )
        );


    $this->plugin_settings[] = array(
        'name'       =>'email_signup_notify_addresses',
        'title'      =>__('Signup Notification Recipients', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('comma-separated list of email addresses to send signup notifications to', Products_Db::PLUGIN_NAME ),
          'value'       => get_bloginfo( 'admin_email' ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'email_signup_notify_subject',
        'title'      =>__('Signup Notification Email Subject', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('subject of the notification email', Products_Db::PLUGIN_NAME ),
					/* translators: the %s will be the name of the website */
          'value'       => sprintf( __('New signup on %s', Products_Db::PLUGIN_NAME ), get_bloginfo('name') ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'email_signup_notify_body',
        'title'      =>__('Signup Notification Email'),
        'group'      => 'signup',
        'options'    => array(
          'type'        =>'text-field',
          'help_text'   => __('notification email body'),
          'value'       => __('<p>A new signup has been submitted</p><ul><li>Name: [first_name] [last_name]</li><li>Email: [email]</li></ul>'),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'signup_show_group_descriptions',
        'title'      => __('Show Field Groups', Products_Db::PLUGIN_NAME ),
        'group'      => 'signup',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('Show groups and group descriptions in the signup form.', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          )
        );
		
		// record form settings

    $this->plugin_settings[] = array(
        'name'       =>'registration_page',
        'title'      =>__('Product Record Page', Products_Db::PLUGIN_NAME ),
        'group'      =>'record',
        'options'    =>array
					(
          'type'       =>'dropdown',
          'help_text'  => __('the page where your product record ([pdb_record] shortcode) is displayed', Products_Db::PLUGIN_NAME ),
					'options'    => $this->_get_pagelist(),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'save_changes_label',
        'title'      =>__('Save Changes Label', Products_Db::PLUGIN_NAME ),
        'group'      =>'record',
        'options'    =>array
					(
          'type'       =>'text',
          'help_text'  => __('label for the save changes button on the record form', Products_Db::PLUGIN_NAME ),
					'value'			 => __('Save Your Changes', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'save_changes_button',
        'title'      =>__('Save Button Text', Products_Db::PLUGIN_NAME ),
        'group'      =>'record',
        'options'    =>array
					(
          'type'       =>'text',
          'help_text'  => __('text on the "save" button', Products_Db::PLUGIN_NAME ),
					'value'			 => _x('Save','a label for a button to save a form', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'show_group_descriptions',
        'title'      => __('Show Group Descriptions', Products_Db::PLUGIN_NAME ),
        'group'      => 'record',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('Show the group description under each group title in the record form.', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'record_updated_message',
        'title'      =>__('Record Updated Message', Products_Db::PLUGIN_NAME ),
        'group'      =>'record',
        'options'    =>array(
          'type'       =>'text',
          'help_text'  => __("the message shown when a record form has been successfully submitted", Products_Db::PLUGIN_NAME ),
          'value'      => __('Your information has been updated:', Products_Db::PLUGIN_NAME ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       => 'send_record_update_notify_email',
        'title'      => __('Send Record Form Update Notification Email', Products_Db::PLUGIN_NAME ),
        'group'      => 'record',
        'options'    => array
          (
          'type'        => 'checkbox',
          'help_text'   => __('Send an email notification that a record has been updated.', Products_Db::PLUGIN_NAME ),
          'value'       => 0,
          'options'     => array( 1, 0 ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'record_update_email_subject',
        'title'      =>__('Record Update Email Subject', Products_Db::PLUGIN_NAME ),
        'group'      => 'record',
        'options'    => array(
          'type'        =>'text',
          'help_text'   => __('subject line for the record update notification email', Products_Db::PLUGIN_NAME ),
          'value'       => sprintf( __("A record has just been updated on %s", Products_Db::PLUGIN_NAME ), get_bloginfo('name') ),
          )
        );

    $this->plugin_settings[] = array(
        'name'       =>'record_update_email_body',
        'title'      =>__('Record Update Notification Email', Products_Db::PLUGIN_NAME ),
        'group'      => 'record',
        'options'    => array(
          'type'        =>'text-field',
          'help_text'   => __('Body of the the email sent when a user updates their record. Any field from the form can be included by using a replacement code of the form: [field_name]. For instance: [last_name],[address],[email] etc. (The field name is under the "name" column on the "Manage Database Fields" page.)  Also available is [date] which will show the date and time of the update', Products_Db::PLUGIN_NAME ),
          'value'       =>__('<p>The following record was updated on [date]:</p><ul><li>Name: [first_name] [last_name]</li><li>Address: [address]</li><li>[city], [state], [country]</li><li>Phone: [phone]</li><li>Email: [email]</li></ul>', Products_Db::PLUGIN_NAME ),
          )
        );

  }
	
	private function _get_pagelist() {
		
		$pagelist = array();
		
		$pages = get_pages( array() );
		
		foreach( $pages as $page ) {
			
			$pagelist[ $page->post_title ] = $page->ID;
		
		}
		
		return $pagelist;
		
	}

	private function _get_display_columns() {

    $columnlist = array(  __('None', Products_Db::PLUGIN_NAME ) => 'none' );

    $columns = Products_Db::get_column_atts( 'frontend' );

    foreach( $columns as $column ) {

      if ( in_array( $column->form_element, array( 'text-line', 'image-upload' ) ) ) $columnlist[ $column->title ] = $column->name;

    }

    return $columnlist;

  }

  /**
   * displays a settings page form using the WP Settings API
   *
   * this function is called by the plugin on it's settings page
   *
   * @return null
   */
  public function show_settings_form() {
    ?>
    <div class="wrap products_db settings-class">
      <h2><?php echo Products_Db::$plugin_title?> <?php _e('Settings', Products_Db::PLUGIN_NAME )?></h2>
      <form action="options.php" method="post">
        <div class="ui-tabs">
          <ul class="ui-tabs-nav">
          <?php foreach ( $this->sections as $id => $title ) printf('<li><a href="#%s">%s</a></li>',Products_Db::make_anchor( $id ), $title ); ?>
          </ul>
          <?php
  
          settings_fields( $this->WP_setting );
  
          do_settings_sections( $this->settings_page );
					
					?>
        </div>
          
          <?php
  
          $args = array(
                        'type'  => 'submit',
                        'class' => $this->submit_class,
                        'value' => $this->submit_button,
                        'name'  => 'submit',
                        );
  
          printf( $this->submit_wrap, FormElement::get_element( $args ) );
  
          ?>
      </form>

    </div>
    <?php

  }
	
	
	/**
	 * displays a section subheader
	 *
	 * note: the header is displayed by WP; this is only what would go under that
	 */
	public function options_section( $section ) {
		
		$name = Products_db::make_anchor( end( explode( '_',$section['id'] ) ) );
		
		return printf('<a id="%1$s" name="%1$s" class="%2$s" ></a>', $name, Products_Db::$css_prefix.'anchor' );
	
	}

}
?>