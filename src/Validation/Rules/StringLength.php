<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

/**
 * Class StringLength
 * @package Dez\Validation\Rules
 */
class StringLength extends Rule
{

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    $value = $this->getValue($field);

    $min = $this->getOption('min', 1);
    $max = $this->getOption('max', PHP_INT_MAX - 1);

    if (mb_strlen($value) > $max || mb_strlen($value) < $min) {
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
    return 'Value length of :field must be between :min and :max.';
  }

}