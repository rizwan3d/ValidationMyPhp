<?php

namespace Rizwan3D\ValidationMyPhp;

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
                    $rule = new $fn();
                    $pass = $rule->check($data, $field, ...$params);
                    if (!$pass) {
                        // get the error message for a specific field and rule if exists
                        // otherwise get the error message from the $validation_errors
                        $errors[$field] = sprintf(
                            $messages[$field][$rule_name] ?? $rule->message,
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
