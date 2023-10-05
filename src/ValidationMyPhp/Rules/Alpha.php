<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Alpha
{
    /** @var string */
    public $message = 'The %s only allows alphabet characters';

    /**
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

        return is_string($data[$field]) && preg_match('/^[\pL\pM]+$/u', $data[$field]);
    }
}
