<?php

namespace Rizwan3D\ValidationMyPhp;

const DEFAULT_VALIDATION_ERRORS = [
    'required'     => 'Please enter the %s',
    'email'        => 'The %s is not a valid email address',
    'min'          => 'The %s must have at least %s characters',
    'max'          => 'The %s must have at most %s characters',
    'between'      => 'The %s must have between %d and %d characters',
    'same'         => 'The %s must match with %s',
    'alphanumeric' => 'The %s should have only letters and numbers',
    'numeric'      => 'The %s should have only numbers',
    'secure'       => 'The %s must have between 8 and 64 characters and contain at least one number, one  upper case letter, one lower case letter and one special character',
    'unique'       => 'The %s already exists',
    'exist'        => 'The %s cannot exists in database',
    'date'         => 'The %s must be a date in %s format',
    'url'          => 'The %s is not valid url',
];

class Validation
{
    public static $DB_HOST;
    public static $DB_NAME;
    public static $DB_USER;
    public static $DB_PASSWORD = '';

    /**
     * Validate.
     *
     * @param array $data
     * @param array $fields
     * @param array $messages
     *
     * @return array
     */
    public function validate(array $data, array $fields, array $messages = []): array
    {
        // get the message rules
        $rule_messages = array_filter($messages, function ($message) {
            return is_string($message);
        });
        // overwrite the default message
        $validation_errors = array_merge(DEFAULT_VALIDATION_ERRORS, $rule_messages);

        $errors = [];

        foreach ($fields as $field => $option) {
            $rules = $this->separator($option, '|');

            foreach ($rules as $rule) {
                // get rule name params
                $params = [];
                // if the rule has parameters e.g., min: 1
                if (strpos($rule, ':')) {
                    [$rule_name, $param_str] = $this->separator($rule, ':');
                    $params = $this->separator($param_str, ',');
                } else {
                    $rule_name = trim($rule);
                }

                $fn = '\\Rizwan3D\\ValidationMyPhp\\Rules\\'.ucfirst($rule_name);

                if (class_exists($fn, true)) {
                    $pass = (new $fn())->check($data, $field, ...$params);
                    if (!$pass) {
                        // get the error message for a specific field and rule if exists
                        // otherwise get the error message from the $validation_errors
                        $errors[$field] = sprintf(
                            $messages[$field][$rule_name] ?? $validation_errors[$rule_name],
                            $field,
                            ...$params
                        );
                    }
                }
            }
        }

        return $errors;
    }

    // Split the array by a separator, trim each element
    // and return the array
    private function separator($str, $separator)
    {
        return array_map('trim', explode($separator, $str));
    }
}
