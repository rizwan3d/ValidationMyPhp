<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Numeric
{
    /** @var string */
    public $message = 'The %s should have only numbers';

    /**
     * Return true if a string is numeric.
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

        return is_numeric($data[$field]);
    }
}
