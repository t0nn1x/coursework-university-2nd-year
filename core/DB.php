<?php

namespace core;

/**
 * Клас для виконання запитів до БД
 */
class DB
{
    protected $pdo;
    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO(
            "mysql: host={$hostname};dbname={$database}",
            $login,
            $password
        );
    }

    /**
     * Виконання запиту на отримання даних з вказаної талиці БД
     */
    public function select(
        string $tableName,
        $fieldsList = "*",
        $conditionArray = null
    ) {
        if (is_string($fieldsList))
            $fieldsListString = $fieldsList;
        if (is_array($fieldsList))
            $fieldsListString = implode(', ', $fieldsList);
        $wherePart = "";
        if (is_array($conditionArray)) {
            $parts = [];
            foreach ($conditionArray as $key => $value) {
                $parts[] = "{$key} = :{$key}";
            }
            $wherePartString = "WHERE " . implode(' AND ', $parts);
        }
        $res = $this->pdo->prepare(
            "SELECT {$fieldsListString} FROM {$tableName} {$wherePartString}"
        );
        $res->execute($conditionArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
    /**
     * Виконання запиту на оновлення даних в вказаній талиці БД
     */
    public function update($tableName, $newValuesArray, $conditionArray)
    {
        $setParts = [];
        $paramsArray = [];
        foreach ($newValuesArray as $key => $value) {
            $setParts[] = "{$key} = :set{$key}";
            $paramsArray['set' . $key] = $value;
        }
        $setPartString = implode(', ', $setParts);

        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts[] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(' AND ', $whereParts);
        $res = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $res->execute($paramsArray);
    }
    /**
     * Виконання запиту на вставку даних в вказану талицю БД
     */
    public function insert($tableName, $newRowArray)
    {
        $fieldsArray = array_keys($newRowArray);
        $fieldsListString = implode(', ', $fieldsArray);
        $paramsArray = [];
        foreach ($newRowArray as $key => $value) {
            $paramsArray[] = ':' . $key;
        }
        $valuesListString = implode(', ', $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ($fieldsListString) VALUES($valuesListString)");
        $res->execute($newRowArray);

    }
    /**
     * Виконання запиту на видалення даних з вказаної талиці БД
     */
    public function delete($tableName, $conditionArray)
    {
        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts[] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(' AND ', $whereParts);
        $res = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
    }

    public function selectWithLike($name)
    {
        $res = $this->pdo->prepare("SELECT * FROM `product` WHERE `name` LIKE :name");
        $res->execute(['name' => "%{$name}%"]);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}
