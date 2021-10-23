<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use CodeKandis\Entities\EntityInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use stdClass;
use function array_key_exists;
use function sprintf;

/**
 * Represents an entity property mapper.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityPropertyMapper implements EntityPropertyMapperInterface
{
	/**
	 * Represents the error message if an entity does not match a given class name.
	 * @var string
	 */
	protected const ERROR_ENTITY_DOES_NOT_MATCH_CLASS_NAME = 'The entity does not match the class name \'%s\'.';

	/**
	 * Represents the error message if a public property does not exist in the entity class.
	 * @var string
	 */
	protected const ERROR_PUBLIC_PROPERTY_NOT_FOUND = 'The public property `%s` does not exist in the entity class.';

	/**
	 * Gets the class name of the entity.
	 * @var string
	 */
	private string $entityClassName;

	/**
	 * Gets the property mappings of the entity.
	 * @var EntityPropertyMappingsInterface
	 */
	private EntityPropertyMappingsInterface $entityPropertyMappings;

	/**
	 * Stores the reflected entity class.
	 * @var ReflectionClass
	 */
	private ReflectionClass $reflectedEntityClass;

	/**
	 * Constructor method.
	 * @param string $entityClassName The class name of the entity.
	 * @param EntityPropertyMappingsInterface $entityPropertyMappings The property mappings of the entity.
	 * @throws ReflectionException The entity class to reflect does not exist.
	 */
	public function __construct( string $entityClassName, EntityPropertyMappingsInterface $entityPropertyMappings )
	{
		$this->entityClassName        = $entityClassName;
		$this->entityPropertyMappings = $entityPropertyMappings;

		$this->reflectedEntityClass = new ReflectionClass( $this->entityClassName );
	}

	/**
	 * {@inheritDoc}
	 */
	public function getEntityClassName(): string
	{
		return $this->entityClassName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getEntityPropertyMappings(): EntityPropertyMappingsInterface
	{
		return $this->entityPropertyMappings;
	}

	/**
	 * {@inheritDoc}
	 */
	public function mapToArray( EntityInterface $data ): array
	{
		if ( false === $data instanceof $this->entityClassName )
		{
			throw new EntityDoesNotMatchClassNameException(
				sprintf(
					static::ERROR_ENTITY_DOES_NOT_MATCH_CLASS_NAME,
					$this->entityClassName
				)
			);
		}

		$mappedArray = [];
		foreach ( $this->entityPropertyMappings as $entityPropertyMapping )
		{
			$propertyName = $entityPropertyMapping->getPropertyName();

			try
			{
				$reflectedProperty = $this->reflectedEntityClass->getProperty( $propertyName );
				if ( true === $reflectedProperty->isStatic() || false === $reflectedProperty->isPublic() )
				{
					throw new PublicPropertyNotFoundException(
						sprintf(
							static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
							$propertyName
						)
					);
				}
			}
			catch ( ReflectionException $exception )
			{
				throw new PublicPropertyNotFoundException(
					sprintf(
						static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
						$propertyName
					)
				);
			}

			$propertyValue                = $reflectedProperty->getValue( $data );
			$converter                    = $entityPropertyMapping->getConverter();
			$mappedValue                  = null === $converter
				? $propertyValue
				: $converter->convertTo( $propertyValue );
			$mappedArray[ $propertyName ] = $mappedValue;
		}

		return $mappedArray;
	}

	/**
	 * {@inheritDoc}
	 * @throws ReflectionException An error occurred during the creation of the entity.
	 */
	public function mapFromArray( array $data ): EntityInterface
	{
		$mappedArray = [];
		foreach ( $this->entityPropertyMappings as $entityPropertyMapping )
		{
			$propertyName = $entityPropertyMapping->getPropertyName();

			try
			{
				$reflectedProperty = $this->reflectedEntityClass->getProperty( $propertyName );
				if ( true === $reflectedProperty->isStatic() || false === $reflectedProperty->isPublic() )
				{
					throw new PublicPropertyNotFoundException(
						sprintf(
							static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
							$propertyName
						)
					);
				}
			}
			catch ( ReflectionException $exception )
			{
				throw new PublicPropertyNotFoundException(
					sprintf(
						static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
						$propertyName
					)
				);
			}

			if ( false === array_key_exists( $propertyName, $data ) )
			{
				continue;
			}

			$propertyValue                = $data[ $propertyName ];
			$converter                    = $entityPropertyMapping->getConverter();
			$mappedValue                  = null === $converter
				? $propertyValue
				: $converter->convertFrom( $propertyValue );
			$mappedArray[ $propertyName ] = $mappedValue;
		}

		return $this->entityClassName::fromArray( $mappedArray );
	}

	/**
	 * {@inheritDoc}
	 */
	public function mapToObject( EntityInterface $data ): stdClass
	{
		if ( false === $data instanceof $this->entityClassName )
		{
			throw new EntityDoesNotMatchClassNameException(
				sprintf(
					static::ERROR_ENTITY_DOES_NOT_MATCH_CLASS_NAME,
					$this->entityClassName
				)
			);
		}

		$mappedObject = new stdClass();
		foreach ( $this->entityPropertyMappings as $entityPropertyMapping )
		{
			$propertyName = $entityPropertyMapping->getPropertyName();

			try
			{
				$reflectedProperty = $this->reflectedEntityClass->getProperty( $propertyName );
				if ( true === $reflectedProperty->isStatic() || false === $reflectedProperty->isPublic() )
				{
					throw new PublicPropertyNotFoundException(
						sprintf(
							static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
							$propertyName
						)
					);
				}
			}
			catch ( ReflectionException $exception )
			{
				throw new PublicPropertyNotFoundException(
					sprintf(
						static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
						$propertyName
					)
				);
			}

			$propertyValue               = $reflectedProperty->getValue( $data );
			$converter                   = $entityPropertyMapping->getConverter();
			$mappedValue                 = null === $converter
				? $propertyValue
				: $converter->convertTo( $propertyValue );
			$mappedObject->$propertyName = $mappedValue;
		}

		return $mappedObject;
	}

	/**
	 * {@inheritDoc}
	 * @throws ReflectionException An error occurred during the creation of the entity.
	 */
	public function mapFromObject( object $data ): EntityInterface
	{
		$reflectedDataObject = new ReflectionObject( $data );

		$mappedObject = new stdClass();
		foreach ( $this->entityPropertyMappings as $entityPropertyMapping )
		{
			$propertyName = $entityPropertyMapping->getPropertyName();

			try
			{
				$reflectedProperty = $this->reflectedEntityClass->getProperty( $propertyName );
				if ( true === $reflectedProperty->isStatic() || false === $reflectedProperty->isPublic() )
				{
					throw new PublicPropertyNotFoundException(
						sprintf(
							static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
							$propertyName
						)
					);
				}
			}
			catch ( ReflectionException $exception )
			{
				throw new PublicPropertyNotFoundException(
					sprintf(
						static::ERROR_PUBLIC_PROPERTY_NOT_FOUND,
						$propertyName
					)
				);
			}

			try
			{
				$reflectedDataProperty = $reflectedDataObject->getProperty( $propertyName );
				if ( true === $reflectedDataProperty->isStatic() || false === $reflectedDataProperty->isPublic() )
				{
					continue;
				}
			}
			catch ( ReflectionException $exception )
			{
				continue;
			}

			$propertyValue               = $data->$propertyName;
			$converter                   = $entityPropertyMapping->getConverter();
			$mappedValue                 = null === $converter
				? $propertyValue
				: $converter->convertFrom( $propertyValue );
			$mappedObject->$propertyName = $mappedValue;
		}

		return $this->entityClassName::fromObject( $mappedObject );
	}
}
