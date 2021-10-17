<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use function count;
use function current;
use function key;
use function next;
use function reset;
use function sprintf;

/**
 * Represents an entity property mapping lists.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityPropertyMappings implements EntityPropertyMappingsInterface
{
	/**
	 * Represents the error message if an entity property mapping for a specific property already exists.
	 * @var string
	 */
	protected const ERROR_ENTITY_PROPERTY_MAPPING_EXISTS = 'An entity property mapping with the property name \'%s\' already exists.';

	/**
	 * Stores the entity property mappings of the list.
	 * @var EntityPropertyMappingInterface[]
	 */
	private array $entityPropertyMappings = [];

	/**
	 * Constructor method.
	 * @param EntityPropertyMappingInterface ...$entityPropertyMappings The entity property mappings of the list.
	 * @throws EntityPropertyMappingExistsException An entity property mapping with a specific property name already exists.
	 */
	public function __construct( EntityPropertyMappingInterface ...$entityPropertyMappings )
	{
		$this->add( ...$entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count(): int
	{
		return count( $this->entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current()
	{
		return current( $this->entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function key()
	{
		return key( $this->entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function next(): void
	{
		next( $this->entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind(): void
	{
		reset( $this->entityPropertyMappings );
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid(): bool
	{
		return null !== $this->key();
	}

	/**
	 * {@inheritDoc}
	 */
	public function add( EntityPropertyMappingInterface ...$entityPropertyMappings ): void
	{
		foreach ( $entityPropertyMappings as $entityPropertyMapping )
		{
			if ( null !== $this->findByPropertyName( $entityPropertyMapping->getPropertyName() ) )
			{
				throw new EntityPropertyMappingExistsException(
					sprintf(
						static::ERROR_ENTITY_PROPERTY_MAPPING_EXISTS,
						$entityPropertyMapping->getPropertyName()
					)
				);
			}
			$this->entityPropertyMappings[] = $entityPropertyMapping;
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function findByPropertyName( string $propertyName ): ?EntityPropertyMappingInterface
	{
		foreach ( $this->entityPropertyMappings as $entityPropertyMapping )
		{
			if ( $entityPropertyMapping->getPropertyName() === $propertyName )
			{
				return $entityPropertyMapping;
			}
		}

		return null;
	}
}
