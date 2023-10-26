<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Seeds;

use CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface;
use CoreKanban\Domain\Entities\Label\Label;

class LabelSeed extends BaseSeed
{
    public function __construct(
        private LabelRepositoryInterface $labelRepository
    ) {}

    public function seed(): void
    {
        $data = json_decode('[
                { "id": 1, "color": "#743C97" },
                { "id": 2, "color": "#F44336" },
                { "id": 3, "color": "#03A9F4" },
                { "id": 4, "color": "#4CAF50" },
                { "id": 5, "color": "#FFC107" },
                { "id": 6, "color": "#9C27B0" },
                { "id": 7, "color": "#3F51B5" },
                { "id": 8, "color": "#9E9E9E" }
                ]
    ', true, 512, JSON_THROW_ON_ERROR);

        foreach ($data as $item) {
            $label = new Label();
            $label->setName((string)$item['id']);
            $label->setColor($item['color']);
            $this->labelRepository->createOrUpdateLabel($label);
        }
    }
}