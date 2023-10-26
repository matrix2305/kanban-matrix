<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Repositories\Label;

use CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface;
use CoreKanban\Domain\Entities\Label\Label;
use CoreKanban\Infrastructure\DataAccess\Repositories\BaseRepository;

class LabelRepository extends BaseRepository implements LabelRepositoryInterface
{
    protected string $entity = Label::class;

    public function getLabelById(int $id) : Label
    {
        return $this->findOne($id);
    }

    public function getAllLabels() : array
    {
        return $this->getAll();
    }

    public function createOrUpdateLabel(Label $label) : void
    {
        $this->createOrUpdate($label);
    }
}