<?php declare( strict_types = 1 );
namespace CodeKandis\Entities;

use JsonSerializable;
use ReflectionException;
use stdClass;

/**
 * Represents the interface of all entities.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityInterface extends JsonSerializable
{
	/**
	 * Converts the entity into an array.
	 * @return array The array representation of the entity.
	 * @throws ReflectionException An error occurred during the conversion of the entity.
	 */
	public function toArray(): array;

	/**
	 * Creates an entity from a data array.
	 * @param array $data The data to create the entity from.
	 * @return EntityInterface The entity created from the array.
	 * @throws ReflectionException An error occurred during the creation of the entity.
	 */
	public static function fromArray( array $data ): EntityInterface;

	/**
	 * Converts the entity into an object.
	 * @return stdClass The object representation of the entity.
	 * @throws ReflectionException An error occurred during the conversion of the entity.
	 */
	public function toObject(): stdClass;

	/**
	 * Creates an entity from a data object.
	 * @param object $data The data to create the entity from.
	 * @return EntityInterface The entity created from the object.
	 * @throws ReflectionException An error occurred during the creation of the entity.
	 */
	public static function fromObject( object $data ): EntityInterface;

	/**
	 * Converts the entity into a JSON serializable array.
	 * @return array The JSON serializable array.
	 * @throws ReflectionException An error occured during the conversion of the entity.
	 */
	public function jsonSerialize(): array;
}
