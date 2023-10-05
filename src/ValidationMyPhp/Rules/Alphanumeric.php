<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Alphanumeric
{
    /** @var string */
    public $message = 'The %s should have only letters and numbers';

    /**
     * Return true if a string is alphanumeric.
     *
     * @param array  $data
     * @param string $field
     *
     * @return bool
     */
    public function check(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return ctype_alnum($data[$field]);
    }
}
