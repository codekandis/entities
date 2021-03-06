<?php declare( strict_types = 1 );
namespace CodeKandis\Entities\Tests;

use function error_reporting;
use function ini_set;
use const E_ALL;

/**
 * Represents the bootstrap script of the tests.
 *
 * @package codekandis/entities
 * @author  Christian Ramelow <info@codekandis.net>
 */
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'html_errors', 'Off' );

require_once __DIR__ . '/../vendor/autoload.php';
