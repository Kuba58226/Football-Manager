<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=DefaultPlayer::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defaultPlayer;

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

    /**
     * @ORM\Column(type="integer", options={"default" : 100})
     */
    private $stamina = 100;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $goals = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $suspendedTo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $injuredTo;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDefaultPlayer(): ?DefaultPlayer
    {
        return $this->defaultPlayer;
    }

    public function setDefaultPlayer(?DefaultPlayer $defaultPlayer): self
    {
        $this->defaultPlayer = $defaultPlayer;

        return $this;
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

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function getGoals(): ?int
    {
        return $this->goals;
    }

    public function setGoals(int $goals): self
    {
        $this->goals = $goals;

        return $this;
    }

    public function getSuspendedTo(): ?\DateTimeInterface
    {
        return $this->suspendedTo;
    }

    public function setSuspendedTo(?\DateTimeInterface $suspendedTo): self
    {
        $this->suspendedTo = $suspendedTo;

        return $this;
    }

    public function getInjuredTo(): ?\DateTimeInterface
    {
        return $this->injuredTo;
    }

    public function setInjuredTo(?\DateTimeInterface $injuredTo): self
    {
        $this->injuredTo = $injuredTo;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
