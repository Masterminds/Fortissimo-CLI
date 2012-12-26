<?php
/**
 * @file
 * Handle arguments and options using symfony console.
 */

namespace Fortissimo\CLI;

use Symfony\Component\Console\Input\InputOption;

class ParseOptions extends \Fortissimo\Command\Base {

  public function expects() {
    return $this
      ->description('Parse the arguments and options.')
      ->usesParam('options', 'The array of values to parse. If none is supplied, ARGV is used.')
      ->usesParam('optionSpec', 'An option spec array. See the code documentation for the correct format.')
        ->whichIsRequired()
      ->usesParam('help', 'Additional help text that will be printed when --help is specified. Normally, minimal help text is generated automatically when --help is in the optionSpec and in the options.')
        ->withFilter('string')
        ->whichHasDefault('')
      ->usesParam('usage', 'Usage information, e.g. "%s [--OPTIONS] ARGS". The %s is filled with the command name.')
        ->whichHasDefault('')
      ->andReturns('An Instance of \Symfony\Component\Console\Input\ArgvInput with all the options and arguments.')
    ;
  }

  public function doCommand() {
    $optionSpec = $this->param('optionSpec');
    $helpText = $this->param('help');
    $options = $this->param('options', NULL);
    $usage = $this->param('usage');
    $output = $this->context->datasource('output'); 

    // Add Help to the optionSpec
    $optionSpec->addOption(new InputOption('help', NULL, InputOption::VALUE_NONE, 'Display the help message.')); 

    // strip out the command before acting on the options.
    $target = $this->getFirstArgument($options);
    $key = array_search($target, $options);
    unset($options[$key]);

    try {
      $argv = new \Symfony\Component\Console\Input\ArgvInput($options, $optionSpec);
    }
    catch (\Exception $e) {

      if ($this->helpArgSet($options)) {
        $this->renderOutput($optionSpec, $helpText, $usage, $output);
      }

      $output->writeln('<comment>' . $e->getMessage() . '</comment>');

      exit;
    }

    // If --help is set we need to display the help message.
    if ($argv->getOption('help')) {
      $this->renderOutput($optionSpec, $helpText, $usage, $output);
    }

    // Add the options and arguments to the context.
    $this->context->addAll($argv->getOptions());
    $this->context->addAll($argv->getArguments());

    return $argv;
  }

  public static function getFirstArgument($argv) {
    
    // Remove the application name.
    array_shift($argv);
    
    foreach ($argv as $arg) {
      if ($arg && '-' === $arg[0]) {
        continue;
      }
      return $arg;
    }
  }

  protected function helpArgSet($argv) {
    
    // Remove the application name.
    array_shift($argv);
    
    foreach ($argv as $arg) {
      if ($arg === '--help') {
        return TRUE;
      }
      return FALSE;
    }
  }

  protected function renderOutput($optionSpec, $helpText, $usage, $output) {

    $output->write(PHP_EOL . $helpText . PHP_EOL . PHP_EOL . $usage . PHP_EOL . PHP_EOL);

    $output->write($optionSpec->asText());
    exit;
  }
}