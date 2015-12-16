<?php

namespace Abc;

use Dez\Validation\Rules\MinMaxString;
use Dez\Validation\Validation;

error_reporting(1); ini_set('display_errors', 1);

include_once '../vendor/autoload.php';

$validation = new Validation($_POST);

$validation->add('test', new MinMaxString([
    'message'   => 'l1 1',
    'min'       => 5,
    'max'       => 32,
]));

$rule   = $validation->add('test2', new MinMaxString([
    'message'   => 'l1 2',
    'min'       => 5,
    'max'       => 32,
]));

$rule->add(new MinMaxString([
    'message'   => '-- mess 1',
    'min'       => 5,
    'max'       => 32,
]))->add(new MinMaxString([
    'message'   => '-- -- mess 1',
    'min'       => 5,
    'max'       => 32,
]));

$rule->add(new MinMaxString([
    'message'   => '-- mess 2',
    'min'       => 5,
    'max'       => 32,
]));

$validation->validate();

var_dump(
    json_encode($validation->getMessages(), JSON_PRETTY_PRINT)
);
