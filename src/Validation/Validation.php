<?php

    namespace Dez\Validation;

    class Validation implements \JsonSerializable {

        protected $messages = [];

        protected $rules    = [];

        protected $dataCollection;

        protected $failure  = false;

        /**
         * Validation constructor.
         * @param array $data
         */
        public function __construct(array $data = [])
        {
            $this->setDataCollection(new DataCollection($data));
        }

        /**
<<<<<<< HEAD
         * @param array $keys
         * @return $this
         */
        public function validate(array $keys = [])
=======
         * @return $this
         */
        public function validate()
>>>>>>> bd7107409fa3de9b364de197f5a022a8ac11a822
        {
            foreach($this->getRules() as $rules) {
                $this->validateRecursive($rules);
            }

<<<<<<< HEAD
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
=======
            return ! $this->isFailure();
        }

        /**
         * @param Rule[] $rules
         * @return bool
         */
        protected function validateRecursive(array $rules = [])
        {
            foreach($rules as $rule) {
                if(! $rule->validate()) {
                    $this->appendMessage($rule->getMessage())->setFailure(true);
                    return false;
                } else if ($rule->hasRules() && ! $this->validateRecursive($rule->getRules())) {
                    return false;
>>>>>>> bd7107409fa3de9b364de197f5a022a8ac11a822
                }
            }*/

            return true;
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
         * @param string $field
         * @param Rule $rule
         * @return Rule
         */
        public function add($field = null, Rule $rule)
        {
<<<<<<< HEAD
            return $this->appendRule($rule);
=======
            $rule->setField($field)->setDataCollection($this->getDataCollection());
            $this->rules[$field][]   = $rule;
            return $rule;
>>>>>>> bd7107409fa3de9b364de197f5a022a8ac11a822
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
<<<<<<< HEAD
            $this->rules[$rule->getField()][]     = $rule;
=======
            $this->rules[$rule->getField()][]   = $rule;
>>>>>>> bd7107409fa3de9b364de197f5a022a8ac11a822
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
         * @return Message[]
         */
        function jsonSerialize()
        {
            return $this->getMessages();
        }

    }