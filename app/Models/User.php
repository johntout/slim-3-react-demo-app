<?php

namespace App\Models;

use Illuminate\Support\Arr;
use App\Entities\UserEntity;
use App\Factories\UserFactory;

class User extends Model
{
    /**
     * @var string
     */
    protected $factory = UserFactory::class;

    /**
     * @param array $filters
     * @return UserEntity
     */
    public static function find(array $filters) :UserEntity
    {
        return parent::find($filters);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function findById(int $id) :UserEntity
    {
        return parent::findById($id);
    }

    /**
     * @param $filters
     * @return UserEntity
     * @throws \Exception
     */
    public static function findOrFail($filters) :UserEntity
    {
        return parent::findOrFail($filters);
    }

    /**
     * @param UserEntity $user
     * @return bool
     */
    public function insert(UserEntity $user) :bool
    {
        $sql = 'INSERT INTO users (
                    name,
                    last_name,
                    email,
                    password,
                    created_by,
                    created_at,
                    updated_by,
                    updated_at
                )
                VALUES(
                    :name,
                    :last_name,
                    :email,
                    :password,
                    :created_by,
                    :created_at,
                    :updated_by,
                    :updated_at
                )
        ';

        $stmt = db()->prepare($sql);
        $stmt->bindValue(':name', $user->name(),\PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $user->last_name(),\PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->email(),\PDO::PARAM_STR);
        $stmt->bindValue(':password', hash_string($user->password()),\PDO::PARAM_STR);
        $stmt->bindValue(':created_by', user()->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':created_at', now(),\PDO::PARAM_STR);
        $stmt->bindValue(':updated_by', user()->id(),\PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', now(),\PDO::PARAM_STR);

        $stmt->execute();

        $user->setId(db()->lastInsertId());

        return true;
    }

    /**
     * @param UserEntity $user
     * @return bool
     */
    public function update(UserEntity $user) :bool
    {
        $valuesToUpdate = [
            'id' => $user->id(),
            'name' => $user->name(),
            'last_name' => $user->last_name(),
            'email' => $user->email(),
            'updated_by' => user()->id(),
            'updated_at' => now(),
        ];

        $sql = 'UPDATE users SET
            name = :name,
            last_name = :last_name,
            email = :email,
            updated_by = :updated_by,
            updated_at = :updated_at
        ';

        if($user->isDirty('password')) {
            $valuesToUpdate['password'] = hash_string($user->password());
            $sql .= ',password =:password';
        }

        $sql .= ' WHERE id=:id';

        $stmt = db()->prepare($sql);
        $stmt->bindValue(':id', $valuesToUpdate['id'],\PDO::PARAM_INT);
        $stmt->bindValue(':name', $valuesToUpdate['name'],\PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $valuesToUpdate['last_name'],\PDO::PARAM_STR);
        $stmt->bindValue(':email', $valuesToUpdate['email'],\PDO::PARAM_STR);
        $stmt->bindValue(':updated_by', $valuesToUpdate['updated_by'],\PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', $valuesToUpdate['updated_at'],\PDO::PARAM_STR);

        if ($user->isDirty('password')) {
            $stmt->bindValue(':password', $valuesToUpdate['password'],\PDO::PARAM_STR);
        }

        $stmt->execute();

        return true;
    }

    /**
     * @param array $filters
     * @return UserEntity
     */
    public function getEntity(array $filters) :UserEntity
    {
        $sql = "SELECT * FROM users WHERE ";
        $stmt = $this->applyFilters($sql, $filters);
        $stmt->execute();
        $row = $stmt->fetch();

        return new UserEntity(Arr::wrap($row));
    }

    /**
     * @param array $filters
     * @return array
     */
    public function allRecords(array $filters = []) :array
    {
        $records = [];
        $sql = "SELECT * FROM users";

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
            $records[] = new UserEntity($row);
        }

        return $records;
    }
}
