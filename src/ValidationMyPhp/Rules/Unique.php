<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Unique
{
    /**
     * Return true if the $value is exist in the column of a table.
     *
     * @param array  $data
     * @param string $field
     * @param string $table
     * @param string $column
     *
     * @return bool
     */
    public function check(array $data, string $field, string $table, string $column): bool
    {
        return (new Exist())->check($data, $field, $table, $column) === false;
    }
}
