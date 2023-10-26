<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Entities\TaskList;

use CoreKanban\Domain\Entities\Common\EntityId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\SortablePosition;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
#[ORM\Table(name: 'task_lists')]
class TaskList
{
    use EntityId;
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[SortablePosition]
    #[ORM\Column(name: '`order`', type: 'integer')]
    private int $order;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'boolean')]
    private bool $completedTaskList = false;

    #[ORM\OneToMany(mappedBy: 'taskList', targetEntity: Task::class, cascade: ['persist', 'remove'], fetch: 'EAGER', orphanRemoval: true)]
    private Collection $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

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

    public function getTasks(bool $order = false): Collection
    {
        if ($order) {
            $query = Criteria::create()->orderBy(['order' => Criteria::ASC]);
            return $this->tasks->matching($query);
        }

        return $this->tasks;
    }

    public function setTasks(Collection $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @return bool
     */
    public function isCompletedTaskList(): bool
    {
        return $this->completedTaskList;
    }

    /**
     * @param bool $completedTaskList
     */
    public function setCompletedTaskList(bool $completedTaskList): void
    {
        $this->completedTaskList = $completedTaskList;
    }
}