<?php
namespace Rizwan3D\ValidationMyPhp\Rules;

class Url
{
    /**
     * Return true if a string is valid URL.
     *
     * @param array  $data
     * @param string $field
     * @param string $format
     *
     * @return bool
     */
    public function check(array $data, string $field, string ...$format): bool
    {
        if (count($format) == 0) {
             return $this->validateCommonScheme($data[$field]);
        } else {
            foreach ($format as $scheme) {
                $method = 'validate' . ucfirst($scheme) .'Scheme';
                if (method_exists($this, $method)) {
                    if ($this->{$method}($data[$field])) {
                        return true;
                    }
                } elseif ($this->validateCommonScheme($data[$field], $scheme)) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * Validate $value is valid URL format
     *
     * @param mixed $value
     * @return bool
     */
    public function validateBasic($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validate $value is correct $scheme format
     *
     * @param mixed $value
     * @param null $scheme
     * @return bool
     */
    public function validateCommonScheme($value, $scheme = null): bool
    {
        if (!$scheme) {
            return $this->validateBasic($value) && (bool) preg_match("/^\w+:\/\//i", $value);
        } else {
            return $this->validateBasic($value) && (bool) preg_match("/^{$scheme}:\/\//", $value);
        }
    }

    /**
     * Validate the $value is mailto scheme format
     *
     * @param mixed $value
     * @return bool
     */
    public function validateMailtoScheme($value): bool
    {
        return $this->validateBasic($value) && preg_match("/^mailto:/", $value);
    }

    /**
     * Validate the $value is jdbc scheme format
     *
     * @param mixed $value
     * @return bool
     */
    public function validateJdbcScheme($value): bool
    {
        return (bool) preg_match("/^jdbc:\w+:\/\//", $value);
    }
}