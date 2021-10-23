<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\Collections;

use ArrayAccess;
use CodeKandis\Entities\ArrayableInterface;
use CodeKandis\Entities\EntityInterface;
use Countable;
use Iterator;
use JsonSerializable;

/**
 * Represents the interface of any collection of entities.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityCollectionInterface extends Countable, Iterator, ArrayAccess, ArrayableInterface, JsonSerializable
{
	/**
	 * Gets the count of entities of the collection.
	 * @return int The count of entities of the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current entity.
	 * @return EntityInterface The current entity.
	 */
	public function current(): EntityInterface;

	/**
	 * Moves the internal pointer to the next entity.
	 */
	public function next(): void;

	/**
	 * Gets the key of the current entity.
	 * @return null|bool|float|int|string The key of the current entity, null if the internal pointer does not point to any entity.
	 */
	public function key();

	/**
	 * Determines if the current internal pointer position is valid.
	 * @return bool True if the current internal pointer position is valid, otherwise false.
	 */
	public function valid(): bool;

	/**
	 * Rewinds the internal pointer.
	 */
	public function rewind(): void;

	/**
	 * Determines if a specified index exists.
	 * @param int $index The index to determine.
	 * @return bool True if the specified index exists, otherwise false.
	 */
	public function offsetExists( $index ): bool;

	/**
	 * Gets the entity at the specified index.
	 * @param int $index The index of the entity.
	 * @return EntityInterface The entity to get.
	 */
	public function offsetGet( $index ): EntityInterface;

	/**
	 * Sets the entity at the specified index.
	 * @param int $index The index of the entity.
	 * @param EntityInterface $entity The entity to set.
	 */
	public function offsetSet( $index, $entity ): void;

	/**
	 * Unsets the entity at a specified index.
	 * @param mixed $index The index of the entity.
	 */
	public function offsetUnset( $index ): void;

	/**
	 * Converts the collection into an array.
	 * @return array The converted array.
	 */
	public function toArray(): array;
}
