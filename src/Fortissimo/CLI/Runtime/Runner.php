<?php
/**
 * @file
 *
 * Generic CLI support.
 */

namespace Fortissimo\CLI\Runtime;

use Fortissimo\Runtime\Runner as BaseRunner;
use Fortissimo\CLI\IO\Output;
use Fortissimo\CLI\IO\Prompt;
use Fortissimo\CLI\IO\BasicOutput;
use Fortissimo\CLI\IO\BasicPrompt;

class Runner extends BaseRunner {
  protected $prompt;
  protected $output;
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
   * @param resource $out
   *   The output stream. This must support fwrite() and family.
   * @param restource $in
   *   The input stream. This must support fread() and family.
   */
  public function __construct($args = NULL, Output $output = NULL, Prompt $prompt = NULL) {

    // Set defaults;
    if (!isset($args)) {
      global $argv;
      $args = $argv;
    }
    if (!isset($output)) {
      $output = new BasicOutput();
    }
    if (!isset($prompt)) {
      $prompt = new BasicPrompt($output);
    }

    $this->args = $args;
    $this->prompt = $prompt;
    $this->output = $output;
  }



  public function initialContext() {
    $cxt = parent::initialContext();
    $cxt->add('output', $this->output);
    $cxt->add('prompt', $this->prompt);
    return $cxt;
  }
}
