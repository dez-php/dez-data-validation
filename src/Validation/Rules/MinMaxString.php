<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Rule;

    /**
     * Class MinMaxString
     * @package Dez\Validation\Rules
     */
    class MinMaxString extends Rule {

        /**
         * @return bool
         */
        public function validate()
        {
            $min  = $this->getOption('min', 1);
            $max  = $this->getOption('max', PHP_INT_MAX - 1);

            $stringLength   = mb_strlen($this->getValue());

            if($min > $stringLength || $max < $stringLength){
                return false;
            }

            return true;
        }

    }