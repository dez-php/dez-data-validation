# dez-data-validation
#### Data Validation Component

## Usage

```php
$validation = new Validation($_GET);

$email      = $validation->required('email');
$email->add(new Email(['message' => 'Your custom message about error. Field :field']));

$passkey    = $validation->required('passkey');
$passkey
    ->add(new Hexadecimal())
    ->add(new Identical([
        'accepted'  => '12FF'
    ]));
    
$passkey->add(new Callback(function($value) {
   return $value > 1024;
}, "Wrong passkey"));

$validation->callback('access', function($value){
    return $value > 2048;
}, "You do not have permissions");

$validation->validate(); // true|false
$validation->isFailure();

foreach($validation->getMessages() as $field => $messages) {
    foreach($messages as $message) {
        echo $field . ' -> ' . $message->getMessage() . PHP_EOL;
    }
}
```