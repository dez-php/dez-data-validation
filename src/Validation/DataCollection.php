<?php

namespace Dez\Validation;

/**
 * Class DataCollection
 * @package Dez\Validation
 */
class DataCollection
{

  /**
   * @var array
   */
  protected $data = [];

  /**
   * DataCollection constructor.
   * @param array $data
   */
  public function __construct(array $data = [])
  {
    if (count($data) > 0) foreach ($data as $key => $item) {
      $this->set($key, $item);
    }
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function set($key, $value)
  {
    $this->data[$key] = $value;
    return $this;
  }

  /**
   * @param $key
   * @param null $default
   * @return null
   */
  public function get($key, $default = null)
  {
    return $this->has($key) ? $this->data[$key] : $default;
  }

  /**
   * @param $key
   * @return bool
   */
  public function has($key)
  {
    return isset($this->data[$key]);
  }

}