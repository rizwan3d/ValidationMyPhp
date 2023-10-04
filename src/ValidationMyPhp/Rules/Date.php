<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Date
{
    public function check(array $data, string $field, string $format): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return date_create_from_format($format, $data[$field]) !== false;
    }
}
