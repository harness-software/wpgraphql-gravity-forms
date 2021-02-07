<?php

namespace WPGraphQLGravityForms\Types\Field\FieldValue;

use GF_Field;
use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Type;
use WPGraphQLGravityForms\Interfaces\FieldValue;
use WPGraphQLGravityForms\Types\Field\TextAreaField;

/**
 * Value for a text area field.
 */
class TextAreaFieldValue implements Hookable, Type, FieldValue {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = TextAreaField::TYPE . 'Value';

	public function register_hooks() {
		add_action( 'graphql_register_types', [ $this, 'register_type' ] );
	}

	public function register_type() {
		register_graphql_object_type(
			self::TYPE,
			[
				'description' => __( 'Textarea field value.', 'wp-graphql-gravity-forms' ),
				'fields'      => [
					'value' => [
						'type'        => 'String',
						'description' => __( 'The value.', 'wp-graphql-gravity-forms' ),
					],
				],
			]
		);
	}

	/**
	 * Get the field value.
	 *
	 * @param array    $entry Gravity Forms entry.
	 * @param GF_Field $field Gravity Forms field.
	 *
	 * @return array Entry field value.
	 */
	public static function get( array $entry, GF_Field $field ) : array {
		$value = isset( $entry[ $field['id'] ] ) ? (string) $entry[ $field['id'] ] : null;

		return [ 'value' => $value ];
	}
}
