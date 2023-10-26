<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Entities\Label;

use CoreKanban\Domain\Entities\Common\EntityId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'labels')]
class Label
{
    use EntityId;

    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'string')]
    public string $color;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}