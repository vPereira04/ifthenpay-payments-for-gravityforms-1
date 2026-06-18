<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

global $wpdb;


delete_option( 'iftp_gf_backofficekey' );


delete_option( 'gravityformsaddon_iftp_gf_settings' );


$iftp_gf_prefixes = array( 'ifthenpay_gf_form_', 'ifthenpay_gf_feed_', 'ifthenpay_gf_draft_', 'ifthenpay_gf_gw_keys_', 'iftp_gf_activation_' );

foreach ( $iftp_gf_prefixes as $iftp_gf_prefix ) {
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery
    $iftp_gf_options = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s",
            $wpdb->esc_like( $iftp_gf_prefix ) . '%',
            $wpdb->esc_like( '_transient_' . $iftp_gf_prefix ) . '%'
        )
    );

    if ( ! empty( $iftp_gf_options ) ) {
        foreach ( $iftp_gf_options as $iftp_gf_option ) {

            if ( strpos( $iftp_gf_option, '_transient_' ) === 0 ) {
                $iftp_gf_transient_name = str_replace( array( '_transient_timeout_', '_transient_' ), '', $iftp_gf_option );
                delete_transient( $iftp_gf_transient_name );
            } else {
                delete_option( $iftp_gf_option );
            }
        }
    }
}


delete_transient( 'ifthenpay_gf_methods' );


$iftp_gf_feed_table = $wpdb->prefix . 'gf_addon_feed';
// phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery
if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $iftp_gf_feed_table ) ) === $iftp_gf_feed_table ) {
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->delete( $iftp_gf_feed_table, array( 'addon_slug' => 'iftp_gf' ), array( '%s' ) );
}
