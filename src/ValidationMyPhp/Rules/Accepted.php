<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Accepted
{
    /** @var string */
    public $message = 'The %s must be accepted';

    /**
     * @param array  $data
     * @param string $field
     * @param int    $min
     * @param int    $max
     *
     * @return bool
     */
    public function check(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        $acceptables = ['yes', 'on', '1', 1, true, 'true'];
        return in_array($data[$field], $acceptables, true);
    }
}
