<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\Collections;

use BadMethodCallException;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\Entities\SerializableArrayInterface;
use function array_key_exists;
use function count;
use function current;
use function get_called_class;
use function in_array;
use function key;
use function next;
use function reset;
use function sprintf;

/**
 * Represents the base class of any collection of entities.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class AbstractEntityCollection implements EntityCollectionInterface
{
	/**
	 * Represents the error message if a method has not been implemented.
	 * @var string
	 */
	protected const ERROR_METHOD_NOT_IMPLEMENTED = 'The method `%s::%s` has not been implemented.';

	/**
	 * Represents the error message if an entity already exists in the collection.
	 * @var string
	 */
	protected const ERROR_ENTITY_EXISTS = 'The entity already exists in the collection.';

	/**
	 * Stores the internal list of enitites of the collection.
	 * @var EntityInterface[]
	 */
	protected array $entities = [];

	/**
	 * Constructor method.
	 * @param EntityInterface[] $entities The initial entities of the collection.
	 * @throws EntityExistsException An entity already exists in the collection.
	 */
	public function __construct( EntityInterface ...$entities )
	{
		$this->add( ...$entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): EntityInterface
	{
		return current( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key()
	{
		return key( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== key( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetExists( $index ): bool
	{
		return array_key_exists( $index, $this->entities );
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetGet( $index ): EntityInterface
	{
		return $this->entities[ $index ];
	}

	/**
	 * {@inheritDoc}
	 * @throws BadMethodCallException The method has not been implemented.
	 */
	public function offsetSet( $index, $entity ): void
	{
		throw new BadMethodCallException(
			sprintf(
				static::ERROR_METHOD_NOT_IMPLEMENTED,
				get_called_class(),
				__METHOD__
			)
		);
	}

	/**
	 * {@inheritDoc}
	 * @throws BadMethodCallException The method has not been implemented.
	 */
	public function offsetUnset( $index ): void
	{
		throw new BadMethodCallException(
			sprintf(
				static::ERROR_METHOD_NOT_IMPLEMENTED,
				get_called_class(),
				__METHOD__
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray(): array
	{
		return $this->entities;
	}

	/**
	 * {@inheritDoc}
	 */
	public function toSerializableArray(): array
	{
		$serializableArray = [];
		foreach ( $this->toArray() as $index => $value )
		{
			if ( $value instanceof SerializableArrayInterface )
			{
				$serializableArray[ $index ] = $value->toSerializableArray();

				continue;
			}

			$serializableArray[ $index ] = $value;
		}

		return $serializableArray;
	}

	/**
	 * {@inheritDoc}
	 */
	public function jsonSerialize(): array
	{
		return $this->toArray();
	}

	/**
	 * Adds entities to the collection.
	 * @param EntityInterface[] $entities The entities to add.
	 * @throws EntityExistsException An entity already exists in the collection.
	 */
	private function add( EntityInterface ...$entities ): void
	{
		foreach ( $entities as $entity )
		{
			if ( true === in_array( $entity, $this->entities, true ) )
			{
				throw new EntityExistsException( static::ERROR_ENTITY_EXISTS );
			}

			$this->entities[] = $entity;
		}
	}
}
