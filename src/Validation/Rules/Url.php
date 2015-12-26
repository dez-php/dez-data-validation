<?php

    namespace Dez\Validation\Rules;

    /**
     * Class Url
     * @package Dez\Validation\Rules
     */
    class Url extends AbstractFilterVar {

        /**
         * @return string
         */
        public function getDefaultMessage()
        {
            return 'Value of :field is not a valid URL address';
        }

        /**
         * @return int
         */
        protected function getFlag()
        {
            return FILTER_VALIDATE_URL;
        }

    }