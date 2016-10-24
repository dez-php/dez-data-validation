<?php

namespace Dez\Validation;

/**
 * Class Rule
 * @package Dez\Validation
 */
abstract class Rule
{

  /**
   * @var array
   */
  protected $options = [];

  /**
   * @var array
   */
  protected $rules = [];

  /**
   * @var DataCollection
   */
  protected $dataCollection = null;

  /**
   * Rule constructor.
   * @param array $options
   */
  public function __construct(array $options = [])
  {
    $this->setOptions($options);
  }

  /**
   * @param $name
   * @param null $default
   * @return null
   */
  public function getOption($name, $default = null)
  {
    return $this->hasOption($name) ? $this->options[$name] : $default;
  }

  /**
   * @param $name
   * @return bool
   */
  public function hasOption($name)
  {
    return isset($this->options[$name]);
  }

  /**
   * @return array
   */
  public function getOptions()
  {
    return $this->options;
  }

  /**
   * @param array $options
   * @return $this
   */
  public function setOptions(array $options = [])
  {
    if (count($options) > 0) {
      foreach ($options as $name => $value) {
        $this->setOption($name, $value);
      }
    }

    return $this;
  }

  /**
   * @param $name
   * @param $value
   * @return $this
   */
  public function setOption($name, $value)
  {
    $this->options[$name] = $value;
    return $this;
  }

  /**
   * @return bool
   */
  public function hasRules()
  {
    return count($this->rules) > 0;
  }

  /**
   * @return Rule[]
   */
  public function getRules()
  {
    return $this->rules;
  }

  /**
   * @param Rule $rule
   * @return $this
   */
  public function add(Rule $rule)
  {
    $this->rules[] = $rule->setDataCollection($this->getDataCollection());
    return $rule;
  }

  /**
   * @return DataCollection
   */
  public function getDataCollection()
  {
    return $this->dataCollection;
  }

  /**
   * @param DataCollection $dataCollection
   * @return $this
   */
  public function setDataCollection(DataCollection $dataCollection)
  {
    $this->dataCollection = $dataCollection;
    return $this;
  }


  /**
   * @param null $field
   * @param null $default
   * @return null
   */
  public function getValue($field = null, $default = null)
  {
    return $this->getDataCollection()->get($field, $default);
  }

  /**
   * @param null $field
   * @param Validation $validation
   * @return bool
   */
  abstract public function validate($field = null, Validation $validation);

  /**
   * @return string
   */
  abstract public function getDefaultMessage();

}