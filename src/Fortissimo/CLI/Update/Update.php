<?php
/**
 * Get the version of the current application from a text file.
 */

namespace Fortissimo\CLI\Update;

/**
 * Update a phar file from a remote location.
 */
class Update extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('Updates the phar file to the latest version.')
      ->usesParam('file', 'location for the newer version of the phar to download.')
        ->whichIsRequired()
      ->usesParam('doUpdate', 'Whether of not to perform an update. Defaults to TRUE.')
        ->withFilter('boolean')
      ->andReturns('Nothing.')
      ;
  }

  public function doCommand() {
    $file = $this->param('file');
    $doUpdate = $this->param('doUpdate', TRUE);

    $output = $this->context->datasource('output');

    if ($doUpdate) {
      $output->writeln('Updating...');

      $localFilename = $_SERVER['argv'][0];
      $tempFilename = basename($localFilename, '.phar').'-temp.phar';
      copy($file, $tempFilename);

      try {
        chmod($tempFilename, 0777 & ~umask());
        // Test to make sure the phar file is valid.
        $phar = new \Phar($tempFilename);
        
        // Replace the existing file with the new on. Note, the variable needs
        // to be freed before renaming will work.
        unset($phar);
        rename($tempFilename, $localFilename);

        $output->writeln('<info>The application has updated successfully.</info>');

      } catch (\Exception $e) {

        // The downloaded file is bad. So, we get rid of it.
        @unlink($tempFilename);
        if (!$e instanceof \UnexpectedValueException && !$e instanceof \PharException) {
            throw $e;
        }

        $output->writeln('<error>The download is corrupted ('.$e->getMessage().').</error>');
      }

    }
    else {
      $output->writeln('<info>Application already up to date.</info>');
    }
  }
}