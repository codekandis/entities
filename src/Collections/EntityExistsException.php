<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\Collections;

use LogicException;

/**
 * Represents an exception if an entity already exists.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
class EntityExistsException extends LogicException
{
}
