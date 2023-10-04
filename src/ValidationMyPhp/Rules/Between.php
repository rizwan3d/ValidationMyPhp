<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Between
{
    /**
     * @param array  $data
     * @param string $field
     * @param int    $min
     * @param int    $max
     *
     * @return bool
     */
    public function check(array $data, string $field, int $min, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        $len = mb_strlen($data[$field]);

        return $len >= $min && $len <= $max;
    }
}
