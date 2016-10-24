<?php

namespace Dez\Validation\Rules;

/**
 * Class IP
 * @package Dez\Validation\Rules
 */
class IP extends AbstractFilterVar
{

  /**
   * @return string
   */
  public function getDefaultMessage()
  {
    return 'Value of :field is not a valid IP address';
  }

  /**
   * @return int
   */
  protected function getFlag()
  {
    return FILTER_VALIDATE_IP;
  }

}