<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\Label;

interface GetAllLabelsUseCaseInterface
{
    public function execute() : array;
}