<?php

namespace App\Models;

use Illuminate\Support\Arr;
use App\Entities\MonsterEntity;
use App\Factories\MonsterFactory;

class Monster extends Model
{
    /**
     * @var string
     */
    protected $factory = MonsterFactory::class;

    /**
     * @param array $filters
     * @return MonsterEntity
     */
    public static function find(array $filters) :MonsterEntity
    {
        return parent::find($filters);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function findById(int $id) :MonsterEntity
    {
        return parent::findById($id);
    }

    /**
     * @param $filters
     * @return MonsterEntity
     */
    public static function findOrFail($filters) :MonsterEntity
    {
        return parent::findOrFail($filters);
    }

    /**
     * @param MonsterEntity $monsterEntity
     * @return bool
     */
    public function insert(MonsterEntity $monsterEntity) :bool
    {
        $sql = 'INSERT INTO monsters (
                    name,
                    type,
                    level,
                    created_by,
                    created_at,
                    updated_by,
                    updated_at
                )
                VALUES(
                    :name,
                    :type,
                    :level,
                    :created_by,
                    :created_at,
                    :updated_by,
                    :updated_at
                )
        ';

        $stmt = db()->prepare($sql);
        $stmt->bindValue(':name', $monsterEntity->name(),\PDO::PARAM_STR);
        $stmt->bindValue(':type', $monsterEntity->type(),\PDO::PARAM_STR);
        $stmt->bindValue(':level', $monsterEntity->level(),\PDO::PARAM_INT);
        $stmt->bindValue(':created_by', user()->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':created_at', now(),\PDO::PARAM_STR);
        $stmt->bindValue(':updated_by', user()->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', now(),\PDO::PARAM_STR);

        $stmt->execute();

        $monsterEntity->setId(db()->lastInsertId());

        return true;
    }

    /**
     * @param MonsterEntity $monsterEntity
     * @return bool
     */
    public function update(MonsterEntity $monsterEntity) :bool
    {
        $sql = 'UPDATE monsters SET
            name =:name,
            type =:type,
            level =:level,
            created_by =:created_by,
            created_at =:created_at,
            updated_by =:updated_by,
            updated_at =:updated_at
            WHERE id =:id
        ';

        $stmt = db()->prepare($sql);
        $stmt->bindValue(':id', $monsterEntity->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':name', $monsterEntity->name(),\PDO::PARAM_STR);
        $stmt->bindValue(':type', $monsterEntity->type(),\PDO::PARAM_STR);
        $stmt->bindValue(':level', $monsterEntity->level(),\PDO::PARAM_INT);
        $stmt->bindValue(':created_by', $monsterEntity->created_by(),\PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $monsterEntity->created_at(),\PDO::PARAM_STR);
        $stmt->bindValue(':updated_by', user()->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', now(),\PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    /**
     * @param array $filters
     * @return MonsterEntity
     */
    public function getEntity(array $filters) :MonsterEntity
    {
        $sql = "SELECT * FROM monsters WHERE";
        $stmt = $this->applyFilters($sql, $filters);
        $stmt->execute();
        $row = $stmt->fetch();

        return new MonsterEntity(Arr::wrap($row));
    }

    /**
     * @param array $filters
     * @return array
     */
    public function allRecords(array $filters = []) :array
    {
        $records = [];
        $sql = "SELECT * FROM monsters";

        if (count($filters) > 0) {
            $sql .= ' WHERE';
            $stmt = $this->applyFilters($sql, $filters);
            $stmt->execute();
        }
        else {
            $stmt  = db()->prepare($sql);
            $stmt->execute();
        }

        while ($row = $stmt->fetch()) {
            $records[] = new MonsterEntity($row);
        }

        return $records;
    }
}
