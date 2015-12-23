<?php

namespace Abc;

use Dez\Validation\Rules\Email;
use Dez\Validation\Rules\StringLength;
use Dez\Validation\Validation;

error_reporting(1); ini_set('display_errors', 1);

include_once '../vendor/autoload.php';

$validation = new Validation($_GET);

$rule = $validation->required('name')->add(new StringLength([
    'min'       => 3,
    'max'       => 64
]));

$betweenRule    = new StringLength([
    'message'   => 'between :min and :max @ :field',
    'min'       => 16,
    'max'       => 64
]);

$rule->add($betweenRule);

$validation->cloneTo('name', 'name_hash');
$email = $validation->required('email', 'NOOOO!!!1 :field required!!!!');

$email
    ->add(new Email());

/// echo validation result
if(! $validation->validate()) {
    foreach($validation->getMessages() as $field => $messages) {
        echo $field . '<br>';

        foreach($messages as $message) {
            echo "  &bull; {$message->getMessage()}<br>";
        }
    }
} else {
    echo 'all ok';
}
