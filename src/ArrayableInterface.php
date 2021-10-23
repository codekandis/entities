<?php declare( strict_types = 1 );
namespace CodeKandis\Entities;

/**
 * Represents the interface of any object convertable into an array.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ArrayableInterface
{
	/**
	 * Converts the object into an array.
	 * @return array The converted array.
	 */
	public function toArray(): array;
}
