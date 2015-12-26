<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\DataCollection;
    use Dez\Validation\Rule;

    class Age extends Rule {

        /**
         * @return bool
         */
        public function validate()
        {
            $minAge = $this->getOption('min', 18);
            $maxAge = $this->getOption('max', 99);
            return ;
        }

    }