<?php

    namespace Dez\Validation;

    class Message implements \JsonSerializable{

        protected $field;

        protected $message;

        /**
         * Message constructor.
         * @param null $field
         * @param null $message
         */
        public function __construct($field = null, $message = null)
        {
            $this->setField($field)->setMessage($message);
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
            $this->message = $message;
            return $this;
        }

        /**
         * @return array
         */
        function jsonSerialize()
        {
            return [
                'message'   => $this->getMessage()
            ];
        }

    }