<?php

namespace LeandroNunes\Evolution\DTO;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

abstract class DTO implements JsonSerializable
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $data = [];

        foreach ($properties as $property) {
            $value = $property->getValue($this);
            if ($value !== null) {
                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
