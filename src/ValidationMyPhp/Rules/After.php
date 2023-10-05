<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class After
{
    /** @var string */
    public $message = 'The %s must be a date after %s.';

    /**
     * @param array  $data
     * @param string $field
     * @param string $time
     * @return bool
     */
    public function check(array $data, string $field, string $time): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return strtotime($time) < strtotime($data[$field]);
    }
}
