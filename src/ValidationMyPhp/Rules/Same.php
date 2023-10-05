<?php
namespace Rizwan3D\ValidationMyPhp\Rules;

class Same
{

    /** @var string */
    public $message = 'The %s must match with %s';

   /**
     * Return true if a string equals the other.
     *
     * @param array  $data
     * @param string $field
     * @param string $other
     *
     * @return bool
     */
    public function check(array $data, string $field, string $other): bool
    {
        if (isset($data[$field], $data[$other])) {
            return $data[$field] === $data[$other];
        }

        if (!isset($data[$field]) && !isset($data[$other])) {
            return true;
        }

        return false;
    }
}