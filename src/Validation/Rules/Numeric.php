<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;


/**
 * Class Numeric
 * @package Dez\Validation\Rules
 */
class Numeric extends Rule
{

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    if (!is_numeric($this->getValue($field))) {
      $message = $this->getOption('message', $this->getDefaultMessage());
      $validation->appendMessage(new Message($field, $message, $this->getOptions() + ['field' => $field]));

      return false;
    }

    return true;
  }

  /**
   * @return string
   */
  public function getDefaultMessage()
  {
    return 'Value of \':field\' must be numeric.';
  }

}