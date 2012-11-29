<?php
/**
 * Setup the input options to be used along with ParseOptions.
 */

namespace Fortissimo\CLI;

use Symfony\Component\Console\Input\InputDefinition;

class SetupOptions extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('Sets up the definition of input arguments..')
      ->andReturns('A Symfony\Component\Console\Input\InputDefinition object')
      ;
  }

  public function doCommand() {
    
    $options = new InputDefinition();

    return $options;
  }
}