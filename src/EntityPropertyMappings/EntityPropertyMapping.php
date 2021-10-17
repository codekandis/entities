<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use CodeKandis\Converters\BiDirectionalConverterInterface;

/**
 * Represents an entity property mapping.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityPropertyMapping implements EntityPropertyMappingInterface
{
	/**
	 * Stores the name of the property to map.
	 * @var string
	 */
	private string $propertyName;

	/**
	 * Stores the two-ways converter of the mapping.
	 * @var ?BiDirectionalConverterInterface
	 */
	private ?BiDirectionalConverterInterface $converter;

	/**
	 * Constructor method.
	 * @param string $propertyName The name of the property to map.
	 * @param ?BiDirectionalConverterInterface $converter The two-ways converter of the mapping.
	 */
	public function __construct( string $propertyName, ?BiDirectionalConverterInterface $converter )
	{
		$this->propertyName = $propertyName;
		$this->converter    = $converter;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPropertyName(): string
	{
		return $this->propertyName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getConverter(): ?BiDirectionalConverterInterface
	{
		return $this->converter;
	}
}
