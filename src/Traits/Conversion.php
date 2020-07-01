<?php

namespace Pramod\ApiConsumer\Traits;

trait Conversion
{
    public function toCollection()
    {
        return collect($this);
    }

    public function toArray()
    {
        return $this->toCollection()->toArray();
    }

    public function toJson()
    {
        return $this->toCollection()->toJson(JSON_PRETTY_PRINT);
    }
}
