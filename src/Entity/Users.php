<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Users
{
	/**
	 * @ORM\PrePersist
	 */
	public function setCreatedAtValue(){
		$this->createdAt = new \DateTime();
		dump( $this->createdAt );
	}
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $email;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

}
