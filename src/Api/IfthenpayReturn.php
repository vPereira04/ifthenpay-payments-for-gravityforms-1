<?php

declare(strict_types=1);

namespace Ifthenpay\GravityForms\Api;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Are you sure?' );
}

final class IfthenpayReturn {

	/**
	 * Read and normalize the GF gateway return params from the current request.
	 *
	 * @return array<string, mixed>
	 */
	public static function get_return_data_from_request(): array {
		$pay      = (string) filter_input( INPUT_GET, 'iftp_gf_pay', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
		$sentinel = (string) filter_input( INPUT_GET, 'iftp_gateway', FILTER_SANITIZE_NUMBER_INT );


		if ( $pay === '' || $sentinel === '' ) {
			return array();
		}

		$return_data = array(
			'iftp_gf_pay' => sanitize_text_field( $pay ),
		);


		$entry_id = absint( (string) filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT ) );
		if ( $entry_id > 0 ) {
			$return_data['entry_id'] = $entry_id;
		}

		$transaction_id = self::sanitize_transaction_id( (string) filter_input( INPUT_GET, 'transactionId', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );
		if ( $transaction_id !== '' ) {
			$return_data['transaction_id'] = $transaction_id;
		}

		$payment_method = sanitize_text_field( (string) filter_input( INPUT_GET, 'PaymentMethod', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );
		if ( $payment_method !== '' ) {
			$return_data['payment_method'] = $payment_method;
		}


		$return_token = sanitize_text_field( (string) filter_input( INPUT_GET, 'iftp_gf_token', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );
		if ( $return_token !== '' ) {
			$return_data['return_token'] = $return_token;
		}

		return $return_data;
	}

	/**
	 * @param array<string, mixed> $return_data
	 */
	public static function get_return_status( array $return_data ): string {
		if ( empty( $return_data['iftp_gf_pay'] ) ) {
			return '';
		}
		return strtolower( sanitize_text_field( (string) $return_data['iftp_gf_pay'] ) );
	}

	private static function sanitize_transaction_id( string $transaction_id ): string {
		$transaction_id = sanitize_text_field( trim( $transaction_id ) );

		if ( $transaction_id === '' || str_contains( $transaction_id, '[' ) ) {
			return '';
		}

		return $transaction_id;
	}

	private function __construct() {}
}
