<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

/**
 * Class Callback
 * @package Dez\Validation\Rules
 */
class Callback extends Rule
{

  /**
   * Callback constructor.
   * @param callable $callback
   * @param null $message
   */
  public function __construct(callable $callback, $message = null)
  {
    $options = [
      'callback' => $callback,
    ];

    if ($message !== null) {
      $options['message'] = $message;
    }

    parent::__construct($options);
  }

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  public function validate($field = null, Validation $validation)
  {
    /** @var \Closure $callback */
    $callback = $this->getOption('callback', function () {
    });
    $value = $this->getValue($field);

    if (!$callback($value, $this, $validation)) {
      $message = $this->getOption('message', $this->getDefaultMessage());
      $validation->appendMessage(new Message($field, $message, ['field' => $field]));

      return false;
    }

    return true;
  }

  /**
   * @return string
   */
  public function getDefaultMessage()
  {
    return "Failure with validation field ':field'";
  }

}