<?php
/**
 * @file
 * A basic prompt implementation using the Symfony Console Dialog.
 */

namespace Fortissimo\CLI\IO;

use \Symfony\Component\Console\Helper\DialogHelper;

class BasicPrompt implements Prompt {

  protected $output = NULL;

  protected $helper = NULL;

  /**
   * Initialize a prompt.
   * @param Fortissimo::CLI::IO::Output $output
   *   Inject the output IO.
   */
  public function __construct(Output $output) {
    $this->output = $output;

    // @todo allow the helper to be passed in.
    $this->helper = new DialogHelper();
  }

  /**
   * Ask a question to the user.
   * @param  string|array $question
   *   The question to ask a user.
   * @param  string $default
   *   The default value if one is not supplied by the user.
   * @retval string
   *   The users answer or the default if it is empty.
   */
  public function ask($question, $default = NULL) {
    return $this->helper->ask($this->output->getConsole(), $question, $default);
  }

  /**
   * Ask the user to respond with Yes or No. Question asked until the user answers.
   * 
   * @param string|array $question
   *   The question to ask a user.
   * @param bool $default
   *   The default answer (true/false). Defaults to true.
   * @retval bool
   *   true or false, depending on what the user choose.
   */
  public function askConfirmation($question, $default = TRUE) {
    return $this->helper->askConfirmation($this->output->getConsole(), $question, $default);
  }

  /**
   * Ask the user a question and validate the answer.
   * @param string|array $question
   *   The question to ask a user.
   * @param callback $validator
   *   A php callback.
   * @param bool $attempts
   *   The max number of attempts to ask before giving up.
   * @param string $default
   *   The default value if none is given.
   * @retval mixed
   *   The validated response.
   */
  public function askAndValidate($question, $validator, $attempts = FALSE, $default = NULL) {
    return $this->helper->askAndValidate($this->output->getConsole(), $question, $validator, $attempts, $default);
  }
}