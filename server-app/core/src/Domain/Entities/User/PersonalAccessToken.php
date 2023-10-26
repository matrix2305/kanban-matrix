<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Entities\User;

use Doctrine\ORM\Mapping as ORM;
use CoreKanban\Domain\Entities\Common\EntityId;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'personal_access_tokens')]
class PersonalAccessToken
{
    use EntityId;
    use TimestampableEntity;

    #[ORM\Column(type: 'string')]
    private string $tokenableType;

    #[ORM\Column(type: 'bigint')]
    private string $tokenableId;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', length: 64, unique: true)]
    private string $token;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $abilities = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $lastUsedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $expiresAt;

    public function getTokenableType(): string
    {
        return $this->tokenableType;
    }

    public function setTokenableType(string $tokenableType): void
    {
        $this->tokenableType = $tokenableType;
    }

    public function getTokenableId(): string
    {
        return $this->tokenableId;
    }

    public function setTokenableId(string $tokenableId): void
    {
        $this->tokenableId = $tokenableId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getAbilities(): ?string
    {
        return $this->abilities;
    }

    public function setAbilities(?string $abilities): void
    {
        $this->abilities = $abilities;
    }

    public function getLastUsedAt(): ?DateTime
    {
        return $this->lastUsedAt;
    }

    public function setLastUsedAt(?DateTime $lastUsedAt): void
    {
        $this->lastUsedAt = $lastUsedAt;
    }

    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?DateTime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }
}