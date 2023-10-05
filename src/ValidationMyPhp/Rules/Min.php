<?php
namespace Rizwan3D\ValidationMyPhp\Rules;

class Min
{
     /**
     * Return true if a string has at least min length.
     *
     * @param array  $data
     * @param string $field
     * @param int    $min
     *
     * @return bool
     */
    public function check(array $data, string $field, int $min): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return mb_strlen($data[$field]) >= $min;
    }
}