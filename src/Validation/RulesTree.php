<?php

    namespace Dez\Validation;

    class RuleContainer {

        protected $rule     = null;

        protected $next     = null;

        public function __construct(Rule $rule)
        {
            $this->rule     = $rule;
        }

    }