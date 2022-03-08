<?php

namespace App\Entity;

use App\Repository\DefaultTeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefaultTeamRepository::class)
 */
class DefaultTeam
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
    private $name;

    /**
     * @ORM\Column(type="bigint")
     */
    private $budget;

    /**
     * @ORM\ManyToOne(targetEntity=DefaultLeague::class, inversedBy="defaultTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defaultLeague;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDefaultLeague(): ?DefaultLeague
    {
        return $this->defaultLeague;
    }

    public function setDefaultLeague(?DefaultLeague $defaultLeague): self
    {
        $this->defaultLeague = $defaultLeague;

        return $this;
    }
}
