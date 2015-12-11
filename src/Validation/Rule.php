<?php

    namespace Dez\Validation;

    abstract class Rule
    {

        protected $field;

        protected $message;

        protected $options  = [];

        protected $next     = null;

        /**
         * Rule constructor.
         * @param string $field
         * @param array $options
         */
        public function __construct($field = null, array $options = [])
        {
            $this->setField($field)->setOptions($options);

            if($this->hasOption('message')) {
                $this->setMessage(new Message($this->getField(), $this->getOption('message')));
            }
        }

        /**
         * @return Message
         */
        public function getMessage()
        {
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
        public function hasNext()
        {
            return (null !== $this->next && $this->next instanceof static);
        }

        /**
         * @return static
         */
        public function getNext()
        {
            return $this->next;
        }


        /**
         * @param Rule $next
         * @return $this
         */
        public function add(Rule $next)
        {
            $this->next = $next;
            return $next;
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

        abstract public function validate($field, $value);

    }