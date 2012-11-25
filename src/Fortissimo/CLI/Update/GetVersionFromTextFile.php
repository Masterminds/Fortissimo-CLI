<?php
/**
 * Get the version of the current application from a text file.
 */

namespace Fortissimo\CLI\Update;

/**
 * This command prints a message to output.
 *
 * The output datasource is expected to conform to the interface
 * \Fortissimo\CLI\IO\Output.
 */
class GetVersionFromTextFile extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('Gets the current version of the application.')
      ->usesParam('file', 'The text file to read the version from.')
        ->whichIsRequired()
      ->andReturns('The current version.')
      ;
  }

  public function doCommand() {
    $file = $this->param('file');

    $version = file_get_contents($file);

    return $version;
  }
}