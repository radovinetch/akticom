<?php

namespace App\Models;

class CSVModel
{
    private $fields = [];

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Получить по ключу из модели значение
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return $this->fields[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }
}
