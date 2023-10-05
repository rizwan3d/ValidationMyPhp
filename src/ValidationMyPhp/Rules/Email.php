<?php
namespace Rizwan3D\ValidationMyPhp\Rules;

class Email
{
/**
     * Return true if the value is a valid email.
     *
     * @param array  $data
     * @param string $field
     *
     * @return bool
     */
    public function check(array $data, string $field): bool
    {
        if (empty($data[$field])) {
            return true;
        }

        return filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }
}