<?php

declare(strict_types=1);

namespace Ifthenpay\GravityForms\Repository;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Are you sure?' );
}

/**
 * Read/write the per-form payment snapshot stored as a WP option.
 * Option key: ifthenpay_gf_form_{form_id}.
 */
final class FormPaymentInfo {

	private const OPTION_PREFIX        = 'ifthenpay_gf_form_';
	private const FEED_OPTION_PREFIX   = 'ifthenpay_gf_feed_';
	private const GATEWAY_DRAFT_PREFIX = 'ifthenpay_gf_draft_';



	public static function get( int $form_id ): array {
		$data = get_option( self::OPTION_PREFIX . $form_id, array() );
		return is_array( $data ) ? $data : array();
	}

	public static function save( int $form_id, array $data ): void {
		update_option( self::OPTION_PREFIX . $form_id, $data, false );
	}

	public static function delete( int $form_id ): void {
		delete_option( self::OPTION_PREFIX . $form_id );
	}



	public static function get_for_feed( int $feed_id ): array {
		$data = get_option( self::FEED_OPTION_PREFIX . $feed_id, array() );
		return is_array( $data ) ? $data : array();
	}

	public static function save_for_feed( int $feed_id, array $data ): void {
		update_option( self::FEED_OPTION_PREFIX . $feed_id, $data, false );
	}

	public static function delete_for_feed( int $feed_id ): void {
		delete_option( self::FEED_OPTION_PREFIX . $feed_id );
	}



	/**
	 * Persist gateway + methods API data for a form so save_feed_settings can
	 * build the full snapshot without making any API calls.
	 *
	 * @param array<int, array<string, mixed>> $pay_methods Provisioned-only rows
	 *                                                      (account, position, img_url, img_url_dark).
	 */
	public static function save_gateway_draft( int $form_id, string $gateway_key, array $pay_methods ): void {
		update_option(
			self::GATEWAY_DRAFT_PREFIX . $form_id,
			array(
				'gateway_key' => $gateway_key,
				'pay_methods' => $pay_methods,
			),
			false
		);
	}

	/** @return array{gateway_key: string, pay_methods: array<int, array<string, mixed>>}|array{} */
	public static function get_gateway_draft( int $form_id ): array {
		$data = get_option( self::GATEWAY_DRAFT_PREFIX . $form_id, array() );
		return is_array( $data ) ? $data : array();
	}



	/**
	 * Bulk-delete all per-form and per-feed snapshots.
	 */
	public static function delete_all(): void {
		global $wpdb;
		foreach ( array( self::OPTION_PREFIX, self::FEED_OPTION_PREFIX, self::GATEWAY_DRAFT_PREFIX ) as $prefix ) {
			$wpdb->query( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching
				$wpdb->prepare(
					"DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
					$wpdb->esc_like( $prefix ) . '%'
				)
			);
		}
	}

	private function __construct() {}
}
