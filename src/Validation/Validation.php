<?php

namespace Dez\Validation;

use Dez\Validation\Rules\Callback;
use Dez\Validation\Rules\Email;
use Dez\Validation\Rules\Identical;
use Dez\Validation\Rules\Required;
use Dez\Validation\Rules\Similarity;
use Dez\Validation\Rules\StringLength;

/**
 * Class Validation
 * @package Dez\Validation
 */
class Validation implements \JsonSerializable
{

  /**
   * @var array
   */
  protected $messages = [];

  /**
   * @var array
   */
  protected $rules = [];

  /**
   * @var DataCollection
   */
  protected $dataCollection;

  /**
   * @var bool
   */
  protected $failure = false;

  /**
   * Validation constructor.
   * @param array $data
   */
  public function __construct(array $data = [])
  {
    $this->setDataCollection(new DataCollection($data));
  }

  /**
   * @return bool
   */
  public function validate()
  {
    foreach ($this->getRules() as $field => $rules) {
      $this->validateRecursive($rules, $field);
    }

    return !$this->isFailure();
  }

  /**
   * @param $field
   * @return null
   */
  public function getRules($field = null)
  {
    return $this->hasRule($field) ? $this->rules[$field] : $this->rules;
  }

  /**
   * @param $field
   * @return bool
   */
  public function hasRule($field)
  {
    return isset($this->rules[$field]);
  }

  /**
   * @param Rule[] $rules
   * @param null $field
   * @return void
   */
  protected function validateRecursive(array $rules = [], $field = null)
  {
    foreach ($rules as $rule) {
      if (!$rule->validate($field, $this)) {
        $this->setFailure(true);
      } else if ($rule->hasRules() === true) {
        $this->validateRecursive($rule->getRules(), $field);
      }
    }
  }

  /**
   * @return boolean
   */
  public function isFailure()
  {
    return $this->failure;
  }

  /**
   * @param boolean $failure
   * @return $this
   */
  public function setFailure($failure)
  {
    $this->failure = $failure;
    return $this;
  }

  /**
   * @param null $field
   * @param Rule $rule
   * @return Rule
   */
  public function rule($field = null, Rule $rule)
  {
    return $this->add($field, $rule);
  }

  /**
   * @param string $field
   * @param Rule $rule
   * @return Rule
   */
  public function add($field = null, Rule $rule)
  {
    return $this->append($field, $rule);
  }

  /**
   * @param null $field
   * @param Rule $rule
   * @return Rule
   */
  public function append($field = null, Rule $rule)
  {
    $rule = $this->prepare($rule);
    $this->rules[$field][] = $this->prepare($rule);
    return $rule;
  }

  /**
   * @param Rule $rule
   * @return Rule
   */
  public function prepare(Rule $rule)
  {
    return $rule->setDataCollection($this->getDataCollection());
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
   * @param null $message
   * @return Required
   */
  public function required($field = null, $message = null)
  {
    $required = $this->prepend($field, new Required());

    if (null !== $message) {
      $required->setOption('message', $message);
    }

    return $required;
  }

  /**
   * @param null $field
   * @param Rule $rule
   * @return Rule
   */
  public function prepend($field = null, Rule $rule)
  {
    if (!isset($this->rules[$field])) {
      $this->rules[$field] = [];
    }

    $rule = $this->prepare($rule);
    array_unshift($this->rules[$field], $rule);

    return $rule;
  }

  /**
   * @param null $field
   * @param null $message
   * @return Rule
   */
  public function email($field = null, $message = null)
  {
    $emailRule = $this->append($field, new Email());

    if (null !== $message) {
      $emailRule->setOption('message', $message);
    }

    return $emailRule;
  }

  /**
   * @param null $field
   * @param null $repeatField
   * @param null $message
   * @return Rule
   */
  public function password($field = null, $repeatField = null, $message = null)
  {
    $passwordRule = $this->append($field, new StringLength([
      'min' => 6,
      'max' => 32,
    ]));

    if ($repeatField !== null) {
      $passwordRule->add(new Similarity([
        'comparable' => $repeatField
      ]));
    }

    if (null !== $message) {
      $passwordRule->setOption('message', $message);
    }

    return $passwordRule;
  }

  /**
   * @param string $field
   * @param string $comparableValue
   * @param string $message
   * @return Rule
   */
  public function identical($field, $comparableValue = null, $message = null)
  {
    $identicalRule = $this->append($field, new Identical([
      'accepted' => $comparableValue
    ]));

    if (null !== $message) {
      $identicalRule->setOption('message', $message);
    }

    return $identicalRule;
  }

  /**
   * @param $field
   * @param callable $callback
   * @param null $message
   * @return Rule
   */
  public function callback($field, callable $callback, $message = null)
  {
    return $this->append($field, new Callback($callback, $message));
  }

  /**
   * @param $origin
   * @param $target
   * @return $this
   */
  public function cloneTo($origin, $target)
  {
    if ($this->hasRule($origin)) {
      $this->rules[$target] = $this->getRules($origin);
    }

    return $this;
  }

  /**
   * @param $field
   * @return Message
   */
  public function getMessage($field)
  {
    return $this->hasMessage($field) ? $this->messages[$field] : new Message();
  }

  /**
   * @param $field
   * @return bool
   */
  public function hasMessage($field)
  {
    return isset($this->messages[$field]);
  }

  /**
   * @param Message $message
   * @return $this
   */
  public function appendMessage(Message $message)
  {
    $this->messages[$message->getField()][] = $message;
    return $this;
  }

  /**
   * @return bool
   */
  public function hasMessages()
  {
    return count($this->messages) > 0;
  }

  /**
   * @return Message[]
   */
  function jsonSerialize()
  {
    return $this->getMessages();
  }

  /**
   * @return Message[]
   */
  public function getMessages()
  {
    return $this->messages;
  }

  /**
   * @param Message[] $messages
   * @return static
   */
  public function setMessages($messages)
  {
    $this->messages = $messages;
    return $this;
  }

}