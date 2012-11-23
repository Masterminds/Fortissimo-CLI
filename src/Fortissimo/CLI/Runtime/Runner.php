<?php
/**
 * @file
 *
 * Generic CLI support.
 */

namespace Fortissimo\CLI\Runtime;

use Fortissimo\Runtime\Runner as BaseRunner;

class Runner extends BaseRunner {
  protected $args;


  /**
   * Create a new CLIRunner.
   *
   * Arguments passed in tell the runner where the arguments, input,
   * and output streams can be found. If none is explicitly specified
   * then we use the system's ARGV, STDOUT, and STDIN as sources.
   *
   * @param array $argv
   *   An indexed array of arguments.
   */
  public function __construct($args = NULL) {

    // Set defaults;
    if (!isset($args)) {
      global $argv;
      $args = $argv;
    }

    $this->args = $args;
  }

}
