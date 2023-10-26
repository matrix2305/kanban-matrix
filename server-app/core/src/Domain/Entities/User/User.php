<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Entities\User;

use CoreKanban\Domain\Entities\Common\EntityId;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use CoreKanban\Domain\Entities\User\Traits\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use CanResetPassword;
    use TimestampableEntity;
    use SoftDeleteableEntity;
    use EntityId;

    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(name: 'username', type: 'string', length: 100, unique: true)]
    private string $username;

    #[ORM\Column(name: 'email', type: 'string', length: 150, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    public string $avatarUrl;

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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     */
    public function setAvatarUrl(string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl;
    }
}