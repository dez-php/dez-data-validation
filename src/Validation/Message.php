<?php

    namespace Dez\Validation;

    class Message implements \JsonSerializable{

        protected $field;

        protected $message;

        protected $replacePairs = [];

        /**
         * Message constructor.
         * @param null $field
         * @param null $message
         * @param array $replacePairs
         */
        public function __construct($field = null, $message = null, array $replacePairs = [])
        {
            $this->setField($field)->setReplacePairs($replacePairs)->setMessage($message);
        }

        /**
         * @return string
         */
        function jsonSerialize()
        {
            return $this->getMessage();
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getMessage();
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
         * @return mixed
         */
        public function getMessage()
        {
            return $this->message;
        }

        /**
         * @param mixed $message
         * @return static
         */
        public function setMessage($message)
        {
            $this->message = strtr($message, $this->getReplacePairs());
            return $this;
        }

        /**
         * @return array
         */
        public function getReplacePairs()
        {
            return $this->replacePairs;
        }

        /**
         * @param array $replacePairs
         * @return static
         */
        public function setReplacePairs(array $replacePairs = [])
        {
            $pairs  = [];

            foreach($replacePairs as $key => $replacement) {
                $pairs[":{$key}"]   = $replacement;
            }

            $this->replacePairs = $pairs;

            return $this;
        }

    }