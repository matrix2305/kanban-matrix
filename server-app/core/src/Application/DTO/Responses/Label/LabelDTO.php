<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Responses\Label;

use CoreKanban\Application\DTO\Responses\BaseDTO;
use CoreKanban\Domain\Entities\Label\Label;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'LabelDTO',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'color', type: 'string')
        ]
    )
]
class LabelDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $color;

    public static function fromEntity(Label $label) : self
    {
        return new self([
            'id' => $label->getId(),
            'name' => $label->getName(),
            'color' => $label->getColor()
        ]);
    }

    public static function fromArray(array $entities) : array
    {
        $dtos = [];
        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity instanceof Label) {
                    $dtos[] = self::fromEntity($entity);
                }
            }
        }

        return $dtos;
    }
}