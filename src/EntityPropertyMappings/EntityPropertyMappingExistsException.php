<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use RuntimeException;

/**
 * Represents an exception if an entity property mapping already exists.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityPropertyMappingExistsException extends RuntimeException
{
}
