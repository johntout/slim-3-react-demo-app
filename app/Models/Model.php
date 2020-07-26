<?php

namespace App\Models;

class Model
{
    /**
     * @var string
     */
    protected $factory;


    /**
     * @param int $id
     * @return mixed
     */
    public static function findById(int $id)
    {
        return (new static)->getEntity(['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public static function find(array $filters)
    {
        return (new static)->getEntity($filters);
    }

    /**
     * @param array $filters
     * @return array
     */
    public static function all(array $filters = [])
    {
        return (new static)->allRecords($filters);
    }

    /**
     * @param $filters
     * @return mixed
     * @throws \Exception
     */
    public static function findOrFail($filters)
    {
        $result = null;

        if (is_array($filters)) {
            $result = static::find($filters);
        }
        else if (is_numeric($filters)) {
            $result = static::findById($filters);
        }

        if (empty($result->id())) {
            throw new \Exception('The requested entity was not found!');
        }

        return $result;
    }

    /**
     * @param $sql
     * @param $filters
     * @param array $orderBys
     * @return bool|\PDOStatement
     */
    protected function applyFilters($sql, $filters, $orderBys = [])
    {
        $columns = array_keys($filters);

        foreach ($columns as $column) {
            if ($column == end($columns)) {
                $sql .= ' '.$column.' = :'.$column.'';
            }
            else {
                $sql .= ' '.$column.' = :'.$column.' AND ';
            }
        }

        if (count($orderBys) > 0) {
            $sql .= ' ORDER BY ';
            foreach ($orderBys as $orderBy) {
                if ($orderBy = end($orderBys)) {
                    $sql.= $orderBy;
                }
                else {
                    $sql.= $orderBy.', ';
                }
            }
        }

        $stmt = db()->prepare($sql);

        foreach ($filters as $column => $value) {
            $stmt->bindValue(':'.$column, $value, is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }

        return $stmt;
    }

    /**
     * @return string
     */
    public function getFactory()
    {
        return $this->factory;
    }
}