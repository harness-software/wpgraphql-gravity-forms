<?php
/**
 * Admin label field property.
 *
 * @package WPGraphQLGravityForms\Types\Field\FieldProperty;
 * @since   0.1.0
 */

namespace WPGraphQLGravityForms\Types\Field\FieldProperty;

use WPGraphQLGravityForms\Interfaces\FieldProperty;

/**
 * Class - AdminLabelProperty
 */
abstract class AdminLabelProperty implements FieldProperty {
	/**
	 * Get 'adminLabel' property.
	 *
	 * Applies to: @TODO
	 *
	 * @return array
	 */
	public static function get() : array {
		return [
			'adminLabel' => [
				'type'        => 'String',
				'description' => __( 'When specified, the value of this property will be used on the admin pages instead of the label. It is useful for fields with long labels.', 'wp-graphql-gravity-forms' ),
			],
		];
	}
}