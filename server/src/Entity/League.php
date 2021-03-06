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

    /**
     * @ORM\OneToMany(targetEntity=MatchResult::class, mappedBy="league")
     */
    private $matchResults;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->matchResults = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getDefaultLeague()->getName();
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

    /**
     * @return Collection<int, MatchResult>
     */
    public function getMatchResults(): Collection
    {
        return $this->matchResults;
    }

    public function addMatchResult(MatchResult $matchResult): self
    {
        if (!$this->matchResults->contains($matchResult)) {
            $this->matchResults[] = $matchResult;
            $matchResult->setLeague($this);
        }

        return $this;
    }

    public function removeMatchResult(MatchResult $matchResult): self
    {
        if ($this->matchResults->removeElement($matchResult)) {
            // set the owning side to null (unless already changed)
            if ($matchResult->getLeague() === $this) {
                $matchResult->setLeague(null);
            }
        }

        return $this;
    }
}
