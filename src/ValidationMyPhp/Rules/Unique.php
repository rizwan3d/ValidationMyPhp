<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

class Unique
{
    /** @var string */
    public $message = 'The %s already exists';

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
    public function check(array $data, string $field, string $table, string $column, string $columnSoftDel = null): bool
    {
        return (new Exist())->check($data, $field, $table, $column, $columnSoftDel) === false;
    }
}
