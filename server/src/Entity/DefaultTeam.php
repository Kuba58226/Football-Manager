<?php

namespace App\Entity;

use App\Repository\DefaultTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="defaultTeam")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity=DefaultLeague::class, inversedBy="defaultTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defaultLeague;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

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

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setDefaultTeam($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getDefaultTeam() === $this) {
                $team->setDefaultTeam(null);
            }
        }

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
