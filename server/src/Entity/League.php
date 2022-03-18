<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeagueRepository::class)
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=DefaultLeague::class, inversedBy="leagues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $defaultLeague;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="league")
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $team->setLeague($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getLeague() === $this) {
                $team->setLeague(null);
            }
        }

        return $this;
    }
}
