<?php
/**
 * A basic command to write cli output via Symfony\Component\Console\Output\ConsoleOutput
 */

namespace Fortissimo\CLI\IO;

/**
 * This command prints a message to output.
 */
class WriteLine extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('The line of test to display in the console.')
      ->usesParam('text', 'The text to display.')
      ->usesParam('output', 'The console output object.')
      ;
  }

  public function doCommand() {
    $text = $this->param('text');
    $output = $this->param('output');

    $output->writeln($text);
  }
}