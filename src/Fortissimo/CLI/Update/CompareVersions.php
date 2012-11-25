<?php
/**
 * Get the version of the current application from a text file.
 */

namespace Fortissimo\CLI\Update;

/**
 * Compares to versions to find if there is a difference.
 */
class CompareVersions extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('Compares to version strings.')
      ->usesParam('version1', 'A version to compare.')
        ->whichIsRequired()
      ->usesParam('version2', 'A second version to compare.')
        ->whichIsRequired()
      ->usesParam('operator', 'A comparison operator.')
      ->andReturns('See version_compare for values.')
      ;
  }

  public function doCommand() {
    $version1 = $this->param('version1');
    $version2 = $this->param('version2');
    $operator = $this->param('operator', '<');

    return version_compare($version1, $version2, $operator);
  }
}