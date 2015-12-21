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
         * @param array $keys
         * @return $this
         */
        public function validate(array $keys = [])
        {
            $data   = count($keys) > 0 ? array_diff($this->data, array_flip($keys)) : $this->data;

            /*foreach($this->getRules() as $field => $rules) {
                foreach($rules as $rule) {
                    if(! $rule->validate($field, $data[$field])) {
                        $this->setMessage($rule->getMessage());
                    } else {
                        while($rule = $rule->getNext()) {
                            if(! $rule->validate($field, $data[$field])) {
                                $this->setMessage($rule->getMessage());
                                break;
                            }
                        }
                    }
                }
            }*/

            return $this;
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
         * @param Rule $rule
         * @return Rule
         */
        public function add(Rule $rule)
        {
            return $this->appendRule($rule);
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
        public function appendRule(Rule $rule)
        {
            $this->rules[$rule->getField()][]     = $rule;
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