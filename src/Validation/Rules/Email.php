<?php

namespace Dez\Validation\Rules;

/**
 * Class Email
 * @package Dez\Validation\Rules
 */
class Email extends AbstractFilterVar
{

  /**
   * @return string
   */
  public function getDefaultMessage()
  {
    return 'Value of :field is not a valid email address';
  }

  /**
   * @return int
   */
  protected function getFlag()
  {
    return FILTER_VALIDATE_EMAIL;
  }

}