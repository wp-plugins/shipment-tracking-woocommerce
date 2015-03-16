<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


if ( defined( 'YITH_YWOT_PREMIUM' ) ) {
	$carrier_option = array(
		'name'    => __( 'Default carrier name', 'ywot' ),
		'id'      => 'ywot_carrier_default_name',
		'type'    => 'select',
		'desc'    => __( '  To display the list of carriers, you have to select them first from the specific "Carriers" tab that you can find in the top part of the screen.', 'ywot' ),
		'options' => Carriers::getInstance()->get_carriers_enabled( true )
	);
} else {
	$carrier_option = array(
		'name' => __( 'Default carrier name', 'ywot' ),
		'type' => 'text',
		'id'   => 'ywot_carrier_default_name'
	);
}

$general_options = array(

	'general' => array(

		'section_general_settings'     => array(
			'name' => __( 'General settings', 'ywot' ),
			'type' => 'title',
			'id'   => 'ywot_section_general'
		),
		'carrier_default_name'         => $carrier_option,
		'order_tracking_text'          => array(
			'name'    => __( 'Text in the Orders page', 'ywot' ),
			'type'    => 'text',
			'id'      => 'ywot_order_tracking_text',
			'default' => __( 'Your order has been picked up by [carrier_name] on [pickup_date]. Your track code is [track_code].', 'ywot' ),
			'desc'    => __( 'This is the text showed in Order details page. You can customize the text using the following 3 placeholders, representing real shipping information.', 'ywot' ) . '[carrier_name], [pickup_date], [track_code]',
			'css'     => 'width:60%'
		),
		'order_tracking_text_position' => array(
			'name'    => __( 'Position of the text in the Orders page', 'ywot' ),
			'type'    => 'select',
			'id'      => 'ywot_order_tracking_text_position',
			'desc'    => __( 'Choose if tracking text have to be shown on top (before order product list) or on bottom (after product list).', 'ywot' ),
			'options' => array(
				'1' => __( 'Show on top', 'ywot' ),
				'2' => __( 'Show on bottom', 'ywot' ),
			),
			'default' => '1'
		),
	)
);

$general_options = apply_filters( 'yith_ywot_general_options', $general_options );

$general_options['general']['section_general_settings_end'] = array(
	'type' => 'sectionend',
	'id'   => 'ywot_section_general_end'
);

if ( ! defined( 'YITH_YWOT_PREMIUM' ) ) {
	$intro_tab                  = array(
		'section_general_settings_videobox' => array(
			'name'    => __( 'Upgrade to the PREMIUM VERSION', 'yit' ),
			'type'    => 'videobox',
			'default' => array(
				'plugin_name'               => __( 'YITH WooCommerce Order Tracking', 'yit' ),
				'title_first_column'        => __( 'Discover Advanced Features', 'yit' ),
				'description_first_column'  => __( 'Upgrade to the PREMIUM VERSION of YITH WOOCOMMERCE ORDER TRACKING to benefit from all features!', 'yit' ),
				'video'                     => array(
					'video_id'          => '118598446',
					'video_image_url'   => YITH_YWOT_ASSETS_IMAGES_URL . 'yith-woocommerce-order-tracking-video.jpg',
					'video_description' => __( 'See YITH WooCommerce Order tracking plugin with full premium features in action', 'yit' ),
				),
				'title_second_column'       => __( 'Get Support and Pro Features', 'yit' ),
				'description_second_column' => __( 'By purchasing the premium version of the plugin, you will take advantage of the advanced features of the product and you will get one year of free updates and support through our platform available 24h/24.', 'yit' ),
				'button'                    => array(
					'href'  => 'http://yithemes.com/themes/plugins/yith-woocommerce-order-tracking',
					'title' => 'Get Support and Pro Features'
				)
			),
			'id'      => 'yith_wcas_general_videobox'
		)
	);
	$general_options['general'] = $intro_tab + $general_options['general'];
}

return $general_options;

