<?php declare( strict_types = 1 );
namespace CodeKandis\Entities;

use ReflectionException;

/**
 * Represents the interface of any serializable object.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SerializableArrayInterface
{
	/**
	 * Converts the object into a serializable array.
	 * @return array The serializable array representation of the object.
	 * @throws ReflectionException An error occurred during the conversion of the object.
	 */
	public function toSerializableArray(): array;
}
