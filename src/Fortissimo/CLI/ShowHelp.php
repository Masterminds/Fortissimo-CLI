<?php
/**
 * @file
 * Automatically generate and show help for the defined routes.
 */
namespace Fortissimo\CLI;

/**
 * Show help text.
 */
class ShowHelp extends \Fortissimo\Command\Base {
  public function expects() {
    return $this->description('Generate help text listing all of the commands.')
      ->andReturns('Nothing.')
      ;
  }

  public function doCommand() {
    global $argv;
    $output = $this->context->datasource('output');
    $ff = $this->context->fortissimo();
    $config = $ff->getRequestPaths();

    $buffer = array();
    $longest = 4;
    foreach ($config['requests'] as $name => $params) {
      $buffer[] = array($name, $config['help']['requests'][$name]);
      $width = strlen($name);
      if ($width > $longest) {
        $longest = $width;
      }
    }

    $output->write("\n<comment>Usage:</comment>\n  " . $argv[0] . " COMMAND [--help | --OPTIONS [..]] [ARGS]\n\n");

    $output->writeln('<comment>Available commands:</comment>');
    foreach ($buffer as $line) {
      $spacing = str_repeat(' ', $longest - strlen($line[0]));

      $output->writeln('  <info>' . $line[0] . "</info>    " . $spacing . $line[1]);
    }
  }
}
