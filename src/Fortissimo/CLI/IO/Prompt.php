<?php
/**
 * @file
 * Provide a basic input component for interacting at the CLI.
 */

namespace Fortissimo\CLI\IO;

interface Prompt {

  /**
   * Initialize a prompt.
   * @param Fortissimo::CLI::IO::Output $output
   *   Inject the output IO.
   */
  public function __construct(Output $output);

  /**
   * Ask a question to the user.
   * @param  string|array $question
   *   The question to ask a user.
   * @param  string $default
   *   The default value if one is not supplied by the user.
   * @retval string
   *   The users answer or the default if it is empty.
   */
  public function ask($question, $default = NULL);

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
  public function askConfirmation($question, $default = TRUE);

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
  public function askAndValidate($question, $validator, $attempts = FALSE, $default = NULL);
}