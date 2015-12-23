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

$validation->validate(); // true|false
$validation->isFailure();

foreach($validation->getMessages() as $field => $messages) {
    foreach($messages as $message) {
        echo $field . ' -> ' . $message->getMessage() . PHP_EOL;
    }
}
```