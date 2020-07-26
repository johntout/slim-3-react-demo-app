<?php

namespace App\Entities;

use App\Interfaces\Arrayable;

class Entity implements Arrayable
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $original_values;

    /**
     * @var string
     */
    protected $entity_events;

    /**
     * @var string
     */
    protected $event_fired;
    
    /**
     * Entity constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->process($attributes);

        $this->syncOriginal();
    }

    /**
     * @return void
     */
    public function syncOriginal()
    {
        $this->setOriginal($this->toArray());
    }

    /**
     * @param array
     */
    public function setOriginal($values)
    {
        $this->original_values = collect($values);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function getOriginal(string $value)
    {
        if ($value == '*') {
            return $this->original_values;
        }

        return $this->original_values->get($value);
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function isDirty(string $value)
    {
        return $this->getOriginal($value) != $this->$value();
    }

    /**
     * @param string $string
     */
    public function fireEvent(string $string)
    {
        if (!empty($this->entity_events)) {
            $events = new $this->entity_events();

            if (method_exists($events, $string)) {
                $this->event_fired = $string;
                $events->$string($this);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new $this->model();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function process($data)
    {
        if (!empty($this->model)) {
            $factory = $this->getModel()->getFactory();

            return $factory::build($data, $this);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function insert() :bool
    {
        $model = $this->getModel();

        try {
            db()->beginTransaction();

            $this->fireEvent('inserting');

            if ($model->insert($this)) {
                $this->fireEvent('inserted');
            }

            db()->commit();
        }
        catch (\PDOException $e) {
            db()->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function update() :bool
    {
        $model = $this->getModel();

        try {
            db()->beginTransaction();

            $this->fireEvent('updating');

            if ($model->update($this)) {
                $this->fireEvent('updated');
            }

            db()->commit();
        }
        catch (\PDOException $e) {
            db()->rollBack();
            throw $e;
        }

        return true;
    }
}