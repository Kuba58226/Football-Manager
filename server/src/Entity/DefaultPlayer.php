<?php

namespace App\Entity;

use App\Repository\DefaultPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefaultPlayerRepository::class)
 */
class DefaultPlayer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=DefaultTeam::class, inversedBy="defaultPlayers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defaultTeam;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalkeeper;

    /**
     * @ORM\Column(type="integer")
     */
    private $defender;

    /**
     * @ORM\Column(type="integer")
     */
    private $midfielder;

    /**
     * @ORM\Column(type="integer")
     */
    private $attacker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getDefaultTeam(): ?DefaultTeam
    {
        return $this->defaultTeam;
    }

    public function setDefaultTeam(?DefaultTeam $defaultTeam): self
    {
        $this->defaultTeam = $defaultTeam;

        return $this;
    }

    public function getGoalkeeper(): ?int
    {
        return $this->goalkeeper;
    }

    public function setGoalkeeper(int $goalkeeper): self
    {
        $this->goalkeeper = $goalkeeper;

        return $this;
    }

    public function getDefender(): ?int
    {
        return $this->defender;
    }

    public function setDefender(int $defender): self
    {
        $this->defender = $defender;

        return $this;
    }

    public function getMidfielder(): ?int
    {
        return $this->midfielder;
    }

    public function setMidfielder(int $midfielder): self
    {
        $this->midfielder = $midfielder;

        return $this;
    }

    public function getAttacker(): ?int
    {
        return $this->attacker;
    }

    public function setAttacker(int $attacker): self
    {
        $this->attacker = $attacker;

        return $this;
    }
}
