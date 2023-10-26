<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Seeds;

abstract class BaseSeed
{
    abstract public function seed() : void;
}