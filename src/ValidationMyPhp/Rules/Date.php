<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Date
{
    /**
     * Return true if a string is in valid Date formate.
     *
     *
     * @param array  $data
     * @param string $field
     * @param string $format
     *
     * @return bool
     */
    public function check(array $data, string $field, string $format): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return date_create_from_format($format, $data[$field]) !== false;
    }
}
