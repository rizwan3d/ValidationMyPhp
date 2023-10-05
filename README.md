# ValidationMyPhp
## Introduction

The `Validation` class is a PHP utility for performing data validation and error handling. It is designed to validate user-provided data against a set of rules and return error messages when validation fails.

## Usage

### Installation

#### Composer

You can easily install the `Validation` class and its dependencies using Composer. If you haven't already installed Composer globally, you can do so by following the instructions on the [Composer website](https://getcomposer.org/download/).

Once Composer is installed, you can add the `validation-my-php` package to your project by running the following command in your project's root directory:

```bash
composer require rizwan3d/validation-my-php
```

### Initialization

To use the `Validation` class, you first need to initialize it and set up your database connection parameters if needed. Here's an example of how to do it:

```php
use ValidationMyPhp\Validation;

Validation::$DB_HOST = '127.0.0.1';
Validation::$DB_NAME = 'database';
Validation::$DB_PASSWORD = '';
Validation::$DB_USER = 'root';

$validation = new Validation();
```

### Data Validation

Once the `Validation` object is created, you can validate data using the `validate` method. You need to provide the data to validate, validation rules, and optional custom error messages. Here's an example of how to validate data:

```php
$data = [
    'firstname' => '',
    'username' => '33158413',
    'address' => 'This is my address',
    'zipcode' => '1',
    'email' => 'jo@',
    'password' => 'test123',
    'password2' => 'test',
];

$fields = [
    'firstname' => 'required | max:255',
    'lastname' => 'required| max: 255', // Note: 'lastname' field is missing in the data
    'address' => 'required | min: 10, max:255',
    'zipcode' => 'between: 5,6',
    'username' => 'required | alphanumeric | between: 3,255 | unique: users,username',
    'password' => 'required | secure',
    'password2' => 'required | same:password'
];

$errors = $validation->validate($data, $fields, [
    'required' => 'The %s is required',
    'password2' => ['same'=> 'Please enter the same password again']
]);

print_r($errors);
```

In the example above, the `validate` method will return an array of error messages for fields that failed validation.

### Validation Rules

You can specify various validation rules for each field in the `fields` array. Here are some common validation rules:

- `required`: The field must not be empty.
- `max:X`: The field's length must not exceed X characters.
- `min:X`: The field's length must be at least X characters.
- `between:X,Y`: The field's length must be between X and Y characters.
- `alphanumeric`: The field must contain only alphanumeric characters.
- `numeric`: The field must contain only numeric characters.d
- `unique:table,column`: Check if the field value is unique in the specified database table and column.
- `exist:table,column`: Check if the field value is exist in the specified database table and column.
- `email`: Validate if the field is a valid email address.
- `secure`: Validate if the field contains a secure password (custom rule).
- `same:field_name`: Validate if the field is the same as another field (e.g., password confirmation).
- `date:format`: Validate if the field is the date in provided formate.

### Custom Error Messages

You can provide custom error messages for each validation rule. In the example, custom error messages are defined in the third argument of the `validate` method. You can use `%s` as a placeholder for the field name in error messages.

## Conclusion

The `Validation` class simplifies the process of validating user input data in PHP applications. It allows you to define validation rules, apply them to data, and retrieve error messages for fields that fail validation. This helps improve the security and reliability of your application by ensuring that user input meets your criteria.
