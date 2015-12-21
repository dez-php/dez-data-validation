<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Rule;

    class MinMaxString extends Rule {

        public function validate()
        {
            $state  = $this->getOption('returnValue', true);
            echo ($state?'OK':'FAIL').' '.$this->getField() . ' => ' . $this->getValue() . ':' . $this->getMessage()->getMessage() . "<br>\n";
            return (bool) $state;
        }

    }