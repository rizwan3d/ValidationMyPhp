<?php

namespace Rizwan3D\ValidationMyPhp\Rules;

use Rizwan3D\ValidationMyPhp\Database;

class Exist
{
    /** @var string */
    public $message = 'The %s must exists in database';

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
        if (!isset($data[$field])) {
            return true;
        }

        $sql = "SELECT $column FROM $table WHERE $column = :value";

        $stmt = Database::db()->prepare($sql);
        $stmt->bindValue(':value', $data[$field]);

        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
