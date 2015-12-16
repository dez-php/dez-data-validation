<?php

    namespace Dez\Validation;

    class Validation implements \JsonSerializable {

        protected $messages = [];

        protected $rules    = [];

        protected $data     = [];

        /**
         * Validation constructor.
         * @param array $data
         */
        public function __construct(array $data = [])
        {
            $this->setData($data);
        }

        /**
         * @return $this
         */
        public function validate()
        {
            foreach($this->getRules() as $rules) {
                $this->validateRecursive($rules);
            }

            return $this;
        }

        /**
         * @param Rule[] $rules
         * @return $this
         */
        protected function validateRecursive(array $rules = [])
        {
            foreach($rules as $rule) {
                if(! $rule->validate($this->getDataByKey($rule->getField()))) {
                    $this->appendMessage($rule->getMessage());
                    break;
                } else {
                    if($rule->hasRules()) {
                        $this->validateRecursive($rule->getRules());
                    }
                }
            }

            return $this;
        }

        /**
         * @param $key
         * @param null $default
         * @return null
         */
        public function getDataByKey($key, $default = null)
        {
            return isset($this->data[$key]) ? $this->data[$key] : $default;
        }

        /**
         * @param array $data
         * @return static
         */
        public function setData(array $data = [])
        {
            $this->data = $data;
            return $this;
        }

        /**
         * @param string $field
         * @param Rule $rule
         * @return Rule
         */
        public function add($field = null, Rule $rule)
        {
            $rule->setField($field);
            $this->rules[$field][]   = $rule;
            return $rule;
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
         * @param $field
         * @return null
         */
        public function getRule($field)
        {
            return $this->hasRule($field) ? $this->rules[$field] : null;
        }

        /**
         * @param Rule $rule
         * @return $this
         */
        public function setRule(Rule $rule)
        {
            $this->rules[$rule->getField()][]   = $rule;
            return $this;
        }

        /**
         * @return Rule[][]
         */
        public function getRules()
        {
            return $this->rules;
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
         * @param $field
         * @return Message
         */
        public function getMessage($field)
        {
            return $this->hasMessage($field) ? $this->messages[$field] : new Message();
        }

        /**
         * @param Message $message
         * @return $this
         */
        public function appendMessage(Message $message)
        {
            $this->messages[$message->getField()][]     = $message;
            return $this;
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

        /**
         * @return Message[]
         */
        function jsonSerialize()
        {
            return $this->getMessages();
        }

    }