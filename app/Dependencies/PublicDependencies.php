<?php 

namespace SimpleLocator\Dependencies;

/**
* Register & Enqueue Styles & Scripts
*/
class PublicDependencies extends DependencyBase 
{

	public function __construct()
	{
		parent::__construct();	
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ));
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ));
	}

	/**
	* Front End Styles
	*/
	public function styles()
	{
		if ( get_option('wpsl_output_css') !== "true" ) return;
		wp_enqueue_style(
			'simple-locator', 
			$this->plugin_dir . '/assets/css/simple-locator.css', 
			'',
			$this->version
		);
	}

	/**
	* Front End Scripts
	*/
	public function scripts()
	{
		$this->addGoogleMaps();

		wp_register_script(
			'simple-locator', 
			$this->plugin_dir . '/assets/js/simple-locator.js', 
			'jquery', 
			$this->version, 
			true
		);

		$localized_data = array(
			'ajaxurl' 				=> admin_url( 'admin-ajax.php' ),
			'locatorNonce' 			=> wp_create_nonce( 'wpsl_locator-locator-nonce' ),
			'distance' 				=> __( 'Distance', 'wpsimplelocator' ), 
			'website' 				=> __('Website', 'wpsimplelocator'),
			'location' 				=> __('location', 'wpsimplelocator'),
			'locations' 			=> __('locations', 'wpsimplelocator'),
			'found_within' 			=> __('found within', 'wpsimplelocator'),
			'phone' 				=> __('Phone', 'wpsimplelocator'),
			'showonmap' 			=> __('Show on Map', 'wpsimplelocator'),
			'viewlocation' 			=> __('View Location', 'wpsimplelocator'),
			'notfounderror' 		=> __('Address not found', 'wpsimplelocator'),
			'mappin' 				=> get_option('wpsl_map_pin'),
			'showgeobutton'			=> $this->settings_repo->showGeoButton('enabled'),
			'geobuttontext'			=> $this->settings_repo->showGeoButton('text'),
			'yourlocation' 			=> __('your location', 'wpsimplelocator'),
			'default_enabled' 		=> $this->settings_repo->showDefaultMap(),
			'default_latitude' 		=> $this->settings_repo->defaultMap('latitude'),
			'default_longitude'		=> $this->settings_repo->defaultMap('longitude'),
			'default_zoom' 			=> intval($this->settings_repo->defaultMap('zoom')),
			'default_user_center'	=> $this->settings_repo->defaultMap('user_location'),
			'autocomplete'			=> $this->settings_repo->autocomplete()
		);
		$localized_data['mapstyles'] = $this->styles_repo->getLocalizedStyles();
		wp_localize_script( 
			'simple-locator', 
			'wpsl_locator', 
			$localized_data
		);
	}

}