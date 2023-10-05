<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Secure
{
    /** @var string */
    public $message = 'The %s must have between 8 and 64 characters and contain at least one number, one  upper case letter, one lower case letter and one special character';

    /**
     * Return true if a password is secure.
     *
     * @param array  $data
     * @param string $field
     *
     * @return bool
     */
    public function check(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return false;
        }

        $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";

        return preg_match($pattern, $data[$field]);
    }
}
