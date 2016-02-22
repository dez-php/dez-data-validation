<?php

namespace Abc;

use Dez\Validation\Rule;
use Dez\Validation\Rules\Callback;
use Dez\Validation\Rules\Email;
use Dez\Validation\Rules\Hexadecimal;
use Dez\Validation\Rules\Identical;
use Dez\Validation\Rules\IP;
use Dez\Validation\Rules\Similarity;
use Dez\Validation\Rules\StringLength;
use Dez\Validation\Rules\Url;
use Dez\Validation\Validation;

error_reporting(1); ini_set('display_errors', 1);

include_once '../vendor/autoload.php';

$validation = new Validation($_GET);

$rule = $validation->required('name')->add(new StringLength([
    'min'       => 3,
    'max'       => 64
]));

$validation->add('test_field123', new Callback(function($value, Rule $rule, Validation $validation){
    return false;
}));


$validation->email('email');

$validation->password('passwd', 'repeat_passwd');

$betweenRule    = new StringLength([
    'message'   => 'between :min and :max @ :field',
    'min'       => 16,
    'max'       => 64
]);

$rule->add($betweenRule);

$validation->cloneTo('name', 'name_hash');
$email = $validation->required('email', 'NOOOO!!!1 :field required!!!!');

$email
    ->add(new Similarity([
        'comparable'    => 'repeat_email'
    ]));

$email
    ->add(new Email());

$email
    ->add(new Url());

$email
    ->add(new IP());

$email
    ->add(new Hexadecimal())->add(new Identical([
        'accepted'  => 'YES'
    ]));

/// echo validation result
if(! $validation->validate()) {
    var_dump($validation->getMessages());
    foreach($validation->getMessages() as $field => $messages) {
        echo $field . '<br>';
        foreach($messages as $message) {
            echo "  &bull; {$message->getMessage()}<br>";
        }
    }
} else {
    echo 'all ok';
}
