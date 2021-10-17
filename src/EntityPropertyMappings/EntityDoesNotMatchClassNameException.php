<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use RuntimeException;

/**
 * Represents an exception if an entity does not match a given class name.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityDoesNotMatchClassNameException extends RuntimeException
{
}
