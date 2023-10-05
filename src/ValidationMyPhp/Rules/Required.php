<?php
namespace Rizwan3D\ValidationMyPhp\Rules;

class Required
{

    /** @var string */
    public $message = 'Please enter the %s';

    /**
     * Return true if a string is not empty.
     *
     * @param array  $data
     * @param string $field
     *
     * @return bool
     */
    public function check(array $data, string $field): bool{
        return isset($data[$field]) && trim($data[$field]) !== '';
    }
}