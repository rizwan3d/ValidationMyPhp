<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Max
{
    /** @var string */
    public $message = 'The %s must have at most %s characters';

    /**
     * Return true if a string cannot exceed max length.
     *
     * @param array  $data
     * @param string $field
     * @param int    $max
     *
     * @return bool
     */
    public function check(array $data, string $field, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return mb_strlen($data[$field]) <= $max;
    }
}
