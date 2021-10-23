<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityPropertyMappings;

use RuntimeException;

/**
 * Represents an exception if a public property does not exist in an entity class.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class PublicPropertyNotFoundException extends RuntimeException
{
}
