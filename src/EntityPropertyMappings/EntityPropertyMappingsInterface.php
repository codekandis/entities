<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use Countable;
use Iterator;

/**
 * Represents the interface of all entity property mapping lists.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityPropertyMappingsInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of entity property mappings in the list.
	 * @return int The amount of entity property mappings in the list.
	 */
	public function count(): int;

	/**
	 * Gets the current entity property mapping of the list.
	 * @return EntityPropertyMappingInterface The current entity property mapping of the list.
	 */
	public function current();

	/**
	 * Gets the key of the current entity property mapping of the list.
	 * @return scalar The key of the current entity property mapping of the list.
	 */
	public function key();

	/**
	 * Moves the internal pointer to the next entity property mapping of the list.
	 */
	public function next(): void;

	/**
	 * Rewinds the internal pointer to the first entity property mapping of the list.
	 */
	public function rewind(): void;

	/**
	 * Determines if the internal pointer points to an entity property mapping of the list.
	 * @return bool True if the internal pointer points to an entity property mapping of the list, false otherwise.
	 */
	public function valid(): bool;

	/**
	 * Adds entity property mappings to the list.
	 * @param EntityPropertyMappingInterface ...$entityPropertyMappings The entity property mappings to add.
	 * @throws EntityPropertyMappingExistsException An entity property mapping with a specific property name already exists.
	 */
	public function add( EntityPropertyMappingInterface ...$entityPropertyMappings ): void;

	/**
	 * Gets an entity property mapping by its property name.
	 * @param string $propertyName The property name.
	 * @return ?EntityPropertyMappingInterface The entity mapping.
	 */
	public function findByPropertyName( string $propertyName ): ?EntityPropertyMappingInterface;
}
