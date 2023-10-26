<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Contracts\Repositories;

use CoreKanban\Domain\Entities\Label\Label;

interface LabelRepositoryInterface
{
    public function getLabelById(int $id) : Label;

    public function getAllLabels() : array;

    public function createOrUpdateLabel(Label $label) : void;
}