<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

/**
 * Class Required
 * @package Dez\Validation\Rules
 */
class Required extends Rule
{

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    if (!$this->getDataCollection()->has($field)) {
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
    return 'Field \':field\' is required.';
  }

}