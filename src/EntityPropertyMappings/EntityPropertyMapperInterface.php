<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use CodeKandis\Entities\EntityInterface;
use stdClass;

/**
 * Represents the interface of all entity property mappers.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityPropertyMapperInterface
{
	/**
	 * Gets the class name of the entity.
	 * @return string The class name of the entity.
	 */
	public function getEntityClassName(): string;

	/**
	 * Gets the property mappings of the entity.
	 * @return EntityPropertyMappingsInterface The property mappings of the entity.
	 */
	public function getEntityPropertyMappings(): EntityPropertyMappingsInterface;

	/**
	 * Maps an entity to an array.
	 * @param EntityInterface $data The entity to map.
	 * @return array The mapped array.
	 * @throws EntityDoesNotMatchClassNameException The entity does not match the entity class name of the entity property mapper.
	 * @throws PublicPropertyNotFoundException A public property does not exist in the entity class.
	 */
	public function mapToArray( EntityInterface $data ): array;

	/**
	 * Maps an array to an object.
	 * @param array $data The array to map.
	 * @return EntityInterface The mapped entity.
	 * @throws PublicPropertyNotFoundException A public property does not exist in the entity class.
	 */
	public function mapFromArray( array $data ): EntityInterface;

	/**
	 * Maps an entity to an object.
	 * @param EntityInterface $data The entity to map.
	 * @return stdClass The mapped object.
	 * @throws EntityDoesNotMatchClassNameException The entity does not match the entity class name of the entity property mapper.
	 * @throws PublicPropertyNotFoundException A public property does not exist in the entity class.
	 */
	public function mapToObject( EntityInterface $data ): stdClass;

	/**
	 * Maps an object to an entity.
	 * @param object $data The object to map.
	 * @return EntityInterface The mapped entity.
	 * @throws PublicPropertyNotFoundException A public property does not exist in the entity class.
	 */
	public function mapFromObject( object $data ): EntityInterface;
}
