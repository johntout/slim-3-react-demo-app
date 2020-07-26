<?php

namespace App\Resources;

class MonsterResource extends GenericResource
{
    public function toArray($resource)
    {
        return [
            'id' => $resource->id(),
            'name' => $resource->name(),
            'type' => $resource->type(),
            'level' => $resource->level(),
            'hp' => $resource->hp(),
            'matk' => $resource->matk(),
            'patk' => $resource->patk(),
            'mdef' => $resource->mdef(),
            'pdef' => $resource->pdef(),
            'gold' => $resource->gold(),
        ];
    }
}