<?php
/**
 * @file
 * The inferface for CLI output.
 */

namespace Fortissimo\CLI\IO;

interface Output {

  const NORMAL = 0;
  const RAW = 1;
  const PLAIN = 2;

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
  function write($messages, $newline = FALSE, $type = 0);

  /**
   * Writes a message or a group of messages to output and add a newline at the end.
   *
   * @param string|array $messages
   *   The message as an array of lines of a single string
   * @param int $type
   *   The type of output
   */
  function writeln($messages, $type = 0);
}