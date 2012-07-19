<?php
/**
 * @file
 * A basic CLI output class using Symfony Console to implement the output.
 */

namespace Fortissimo\CLI\IO;

use \Symfony\Component\Console\Output\ConsoleOutput;

/**
 * This class provides a basic cli output mechanism.
 *
 * If you're wondering why this class exists when it's basically a proxy to
 * Symfony and that could just be used it's because there could be other
 * implementations having nothing to do with Symfony.
 */
class BasicOutput implements Output {
  
  /**
   * The symfony console output doing the heavy lifting.
   */
  protected $console = NULL;

  /**
   * Setup the Basic Output class.
   * @param [type] $console [description]
   */
  function __construct(ConsoleOutput $console = NULL) {
    if (is_null($console)) {
      $this->console = new ConsoleOutput();
    }
    else {
      $this->console = $console;
    }
  }

  /**
   * Writes a message or a group of messages to the output.
   *
   * @param string|array $messages
   *   The message as an array of lines or a single string
   * @param bool $newline
   *   Whether to add a newline or not
   * @param int $type
   *   The type of output
   */
  function write($messages, $newline = FALSE, $type = 0) {
    return $this->console->write($messages, $newline, $type);
  }

  /**
   * Writes a message or a group of messages to output and add a newline at the end.
   *
   * @param string|array $messages
   *   The message as an array of lines of a single string
   * @param int $type
   *   The type of output
   */
  function writeln($messages, $type = 0) {
    return $this->console->writeln($messages, $type);
  }

  /**
   * Get the Symfony Console Output
   * 
   * @retval Symfony::Component::Console::Output::ConsoleOutput
   */
  public function getConsole() {
    return $this->console;
  }
}