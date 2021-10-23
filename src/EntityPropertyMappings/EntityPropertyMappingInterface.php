<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use CodeKandis\Converters\BiDirectionalConverterInterface;

/**
 * Represents the interface of all entity property mappings.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityPropertyMappingInterface
{
	/**
	 * Gets the name of the property to map.
	 * @return string The name of the property to map.
	 */
	public function getPropertyName(): string;

	/**
	 * Gets the two-ways converter of the mapping.
	 * @return ?BiDirectionalConverterInterface The two-ways converter of the mapping.
	 */
	public function getConverter(): ?BiDirectionalConverterInterface;
}
