<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\EntityExtenders;

/**
 * Represents the interface of all entity extenders.
 * @package codekandis/entities
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityExtenderInterface
{
	/**
	 * Extends the entites.
	 */
	public function extend(): void;
}
