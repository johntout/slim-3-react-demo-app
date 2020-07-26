<?php

namespace App\Traits;

trait HasStatsAttributes
{
    /**
     * @var int
     */
    protected $hp;

    /**
     * @var int
     */
    protected $patk;

    /**
     * @var int
     */
    protected $matk;

    /**
     * @var int
     */
    protected $pdef;

    /**
     * @var int
     */
    protected $mdef;

    /**
     * @var int
     */
    protected $gold;

    /**
     * @return int
     */
    public function hp()
    {
        return $this->hp;
    }

    /**
     * @return int
     */
    public function patk()
    {
        return $this->patk;
    }

    /**
     * @return int
     */
    public function matk()
    {
        return $this->matk;
    }

    /**
     * @return int
     */
    public function pdef()
    {
        return $this->pdef;
    }

    /**
     * @return int
     */
    public function mdef()
    {
        return $this->mdef;
    }

    /**
     * @return int
     */
    public function gold()
    {
        return $this->gold;
    }

    /**
     * @param $value
     */
    public function setHp($value)
    {
        $this->hp = $value;
    }

    /**
     * @param $value
     */
    public function setMatk($value)
    {
        $this->matk = $value;
    }

    /**
     * @param $value
     */
    public function setPatk($value)
    {
        $this->patk = $value;
    }

    /**
     * @param $value
     */
    public function setMdef($value)
    {
        $this->mdef = $value;
    }

    /**
     * @param $value
     */
    public function setPdef($value)
    {
        $this->pdef = $value;
    }

    /**
     * @param $value
     */
    public function setGold($value)
    {
        $this->gold = $value;
    }

    /**
     * Generate stats
     *
     * @return $this
     * @throws \Exception
     */
    public function generateStats()
    {
        if (!property_exists($this, 'type')) {
            throw new \Exception('Define a property called type on your entity!');
        }

        if (!property_exists($this, 'level')) {
            throw new \Exception('Define a property called level on your entity!');
        }

        // Calculate stats according to type
        switch ($this->type) {
            case 'outlaw':
                $hp = $this->level * 100;
                $patk = ($this->level + 5) * 3;
                $matk = 5;
                $mdef = $this->level + 12;
                $pdef = $this->level + 2;
                $gold = $this->level * 3;
                break;

            case 'shadowborne':
                $hp = $this->level * 30;
                $patk = ($this->level + 7) * 5;
                $matk = 12;
                $mdef = $this->level + 1;
                $pdef = $this->level + 3;
                $gold = $this->level * 4;
                break;

            case 'arcanist':
                $hp = $this->level * 50;
                $patk = 7;
                $matk = 5;
                $mdef = $this->level * 10;
                $pdef = ($this->level + 2) * 4;
                $gold = $this->level * 4;
                break;

            case 'acolyte':
                $hp = $this->level * 60;
                $patk = ($this->level + 3) * 2;
                $matk = ($this->level + 2) * 3;
                $mdef = $this->level + 3;
                $pdef = $this->level + 3;
                $gold = $this->level * 2;
                break;

            case 'dragon':
                $hp = $this->level * 600;
                $patk = ($this->level + 15) * 3;
                $matk = ($this->level + 4) * 8;
                $mdef = $this->level + 30;
                $pdef = ($this->level + 5) * 5;
                $gold = $this->level * 15;
                break;

            default:
                throw new \Exception('Undefined type!');
                break;
        }

        // Create stats variance
        $hp = $this->reduceStatRandomly($hp);
        $patk = $this->reduceStatRandomly($patk);
        $matk = $this->reduceStatRandomly($matk);
        $mdef = $this->reduceStatRandomly($mdef);
        $pdef = $this->reduceStatRandomly($pdef);
        $gold = $this->reduceStatRandomly($gold);

        // Set stats to entity
        $this->setHp($hp);
        $this->setPatk($patk);
        $this->setMatk($matk);
        $this->setMdef($mdef);
        $this->setPdef($pdef);
        $this->setGold($gold);

        return $this;
    }

    /**
     * @param $stat
     * @return float|int
     */
    public function reduceStatRandomly($stat)
    {
        return intval($stat - (rand(5, 15) / 100) * $stat);
    }
}