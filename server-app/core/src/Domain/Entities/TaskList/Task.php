<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Entities\TaskList;

use CoreKanban\Domain\Entities\Common\EntityId;
use CoreKanban\Domain\Entities\Label\Label;
use CoreKanban\Domain\Entities\User\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\SortablePosition;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
#[ORM\Table(name: 'tasks')]
class Task
{
    use EntityId;
    use TimestampableEntity;

    #[SortablePosition]
    #[ORM\Column(name: '`order`', type: 'integer')]
    private int $order = 0;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $startOn = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $dueOn = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $completedOn = null;


    #[ORM\ManyToOne(targetEntity: TaskList::class, cascade: ['persist'], fetch: 'EAGER', inversedBy: 'tasks')]
    private TaskList $taskList;

    #[ORM\ManyToMany(targetEntity: User::class, fetch: 'EAGER')]
    #[ORM\JoinTable(
        name: 'tasks_users',
        joinColumns: new ORM\JoinColumn('user_id', referencedColumnName: 'id'),
        inverseJoinColumns: new ORM\JoinColumn(name: 'task_id', referencedColumnName: 'id')
    )]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Label::class, fetch: 'EAGER')]
    #[ORM\JoinTable(
        name: 'tasks_labels',
        joinColumns: new ORM\JoinColumn('user_id', referencedColumnName: 'id'),
        inverseJoinColumns: new ORM\JoinColumn(name: 'task_id', referencedColumnName: 'id')
    )]
    private Collection $labels;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->labels = new ArrayCollection();
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime|null
     */
    public function getStartOn(): ?DateTime
    {
        return $this->startOn;
    }

    /**
     * @param DateTime|null $startOn
     */
    public function setStartOn(?DateTime $startOn): void
    {
        $this->startOn = $startOn;
    }

    /**
     * @return DateTime|null
     */
    public function getDueOn(): ?DateTime
    {
        return $this->dueOn;
    }

    /**
     * @param DateTime|null $dueOn
     */
    public function setDueOn(?DateTime $dueOn): void
    {
        $this->dueOn = $dueOn;
    }

    /**
     * @return DateTime|null
     */
    public function getCompletedOn(): ?DateTime
    {
        return $this->completedOn;
    }

    /**
     * @param DateTime|null $completedOn
     */
    public function setCompletedOn(?DateTime $completedOn): void
    {
        $this->completedOn = $completedOn;
    }

    public function getTaskList(): TaskList
    {
        return $this->taskList;
    }

    public function setTaskList(TaskList $taskList): void
    {
        $this->taskList = $taskList;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param Collection $users
     */
    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    /**
     * @return Collection
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    /**
     * @param Collection $labels
     */
    public function setLabels(Collection $labels): void
    {
        $this->labels = $labels;
    }
}