<?php

namespace App\Entities;

use App\Models\User;
use App\Events\UserEvents;

class UserEntity extends Entity
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @var string
     */
    protected $entity_events = UserEvents::class;

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
    protected $last_name;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $email;

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
     * @var string
     */
    protected $updated_at;

    /* GETTERS */

    /**
     * @return bool
     */
    public function isGuest() :bool
    {
        if ($this->id() == 0) {
            return true;
        }

        return false;
    }

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
     * @return string
     */
    public function last_name()
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return $this->name.' '.$this->last_name;
    }

    /**
     * @return string|null
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function created_by()
    {
        return $this->created_by;
    }

    /**
     * @return string
     */
    public function created_at()
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function updated_by()
    {
        return $this->updated_by;
    }

    /**
     * @return string
     */
    public function updated_at()
    {
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
    public function setLastName($value)
    {
        $this->last_name = $value;
    }

    /**
     * @param $value
     */
    public function setPassword($value)
    {
        $this->password = $value;
    }

    /**
     * @param $value
     */
    public function setEmail($value)
    {
        $this->email = $value;
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