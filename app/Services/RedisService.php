<?php

namespace App\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;

class RedisService
{

    private $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function setType(string $name)
    {
        $types = $this->redis->get('types');

        if(!str_contains($types, $name))
            throw new \InvalidArgumentException();

        $this->redis->set('types', $types . ',' . $name);
    }

    public function removeType(string $name)
    {
        $types = $this->redis->get('types');

        if($types == null)
            throw new ModelNotFoundException();

        if(!str_contains($types, $name))
            throw new ModelNotFoundException();

        $this->redis->set('types', str_replace(','.$name, "", $types));
    }
}
