<?php

    namespace Dez\Validation;

    abstract class Rule
    {

        protected $field;

        protected $message;

        protected $options = [];

        protected $rules = [];

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
         * @return Message
         */
        public function getMessage()
        {
            $this->setMessage(new Message($this->getField(), $this->getOption('message')));

            return $this->message;
        }

        /**
         * @param Message $message
         * @return static
         */
        public function setMessage(Message $message)
        {
            $this->message = $message;
            return $this;
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
         * @param $name
         * @param null $default
         * @return null
         */
        public function getOption($name, $default = null)
        {
            return $this->hasOption($name) ? $this->options[$name] : $default;
        }

        /**
         * @return array
         */
        public function getOptions()
        {
            return $this->options;
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
            $this->rules[] = $rule->setField($this->getField())->setDataCollection($this->getDataCollection());
            return $rule;
        }

        /**
         * @return mixed
         */
        public function getField()
        {
            return $this->field;
        }

        /**
         * @param mixed $field
         * @return static
         */
        public function setField($field)
        {
            $this->field = $field;
            return $this;
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
         * @param null $default
         * @return mixed
         */
        public function getValue($default = null)
        {
            return $this->getDataCollection()->get($this->getField(), $default);
        }

        /**
         * @return mixed
         */
        abstract public function validate();

    }