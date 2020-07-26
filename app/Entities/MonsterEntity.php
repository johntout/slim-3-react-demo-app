<?php

namespace App\Entities;

use App\Helpers\App;
use App\Models\Monster;
use App\Traits\HasStatsAttributes;

class MonsterEntity extends Entity
{
    use HasStatsAttributes;

    /**
     * @var string
     */
    protected $model = Monster::class;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var int
     */
    protected $created_by;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var int
     */
    protected $updated_by;

    /**
     * @var int
     */
    protected $updated_at;

    /* GETTERS */

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function created_by()
    {
        return $this->created_by;
    }

    /**
     * @return int
     */
    public function level()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @param bool $format
     * @return string
     */
    public function created_at($format = false)
    {
        if ($format) {
            return App::formatDate($this->created_at, 'Y-m-d H:i:s', 'd M Y H:i:s');
        }

        return $this->created_at;
    }

    /**
     * @return int
     */
    public function updated_by()
    {
        return $this->created_by;
    }

    /**
     * @param bool $format
     * @return string
     */
    public function updated_at($format = false)
    {
        if ($format) {
            return App::formatDate($this->updated_at, 'Y-m-d H:i:s', 'd M Y H:i:s');
        }

        return $this->updated_at;
    }

    /* SETTERS */

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->id = $value;
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * @param $value
     */
    public function setLevel($value)
    {
        $this->level = $value;
    }

    /**
     * @param $value
     */
    public function setType($value)
    {
        $this->type = $value;
    }

    /**
     * @param $value
     */
    public function setCreatedBy($value)
    {
        $this->created_by = $value;
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->created_at = $value;
    }

    /**
     * @param $value
     */
    public function setUpdatedBy($value)
    {
        $this->updated_by = $value;
    }

    /**
     * @param $value
     */
    public function setUpdatedAt($value)
    {
        $this->updated_at = $value;
    }
}