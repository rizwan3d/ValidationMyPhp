<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Extension
{
    /** @var string */
    public $message = 'The %s is not valid extension';

    /**
     * Return true if a string is valid URL.
     *
     * @param array  $data
     * @param string $field
     * @param string $ext
     *
     * @return bool
     */
    public function check(array $data, string $field, string ...$ext): bool
    {
        $allowedExtensions = [];
        foreach ($ext as $e) {
            $allowedExtensions[] = ltrim($e, '.');
        }

        $ext = strtolower(pathinfo($data[$field], PATHINFO_EXTENSION));
        return ($ext && in_array($ext, $allowedExtensions)) ? true : false;
    }
}
