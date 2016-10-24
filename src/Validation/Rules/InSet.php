<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

/**
 * Class InSet
 * @package Dez\Validation\Rules
 */
class InSet extends Rule
{

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    $set = $this->getOption('set', []);
    $set = is_array($set) ? $set : [$set];

    $value = $this->getValue($field);

    if(!in_array($value, $set)) {
      $message = $this->getOption('message', $this->getDefaultMessage());

      $replacements = ['field' => $field, 'set' => implode(', ', $set)];
      $validation->appendMessage(new Message($field, $message, $replacements));

      return false;
    }

    return true;
  }

  /**
   * @return string
   */
  public function getDefaultMessage()
  {
    return 'Value of field ":field" should be one of (:set)';
  }

}