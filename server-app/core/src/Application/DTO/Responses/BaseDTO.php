<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Responses;

use ReflectionProperty;
use ReflectionClass;

abstract class BaseDTO
{
    public static string $dateTimeFormat = 'd.m.Y H:i';
    public static string $dateFormat = 'd.m.Y';

    public function __construct(array $parameters)
    {
        $class = new ReflectionClass(static::class);
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            if (array_key_exists($property, $parameters)) {
                $this->{$property} = $parameters[$property] ?? null;
            }
        }
    }
}