<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

/**
 * Class AbstractFilterVar
 * @package Dez\Validation\Rules
 */
abstract class AbstractFilterVar extends Rule
{

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    $value = $this->getValue($field);

    if (!filter_var($value, $this->getFlag())) {

      $message = $this->getOption('message', $this->getDefaultMessage());
      $validation->appendMessage(new Message($field, $message, $this->getOptions() + ['field' => $field]));

      return false;
    }

    return true;
  }

  /**
   * @return integer
   */
  abstract protected function getFlag();

}