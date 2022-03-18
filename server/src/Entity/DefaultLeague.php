<?php

namespace App\Entity;

use App\Repository\DefaultLeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefaultLeagueRepository::class)
 */
class DefaultLeague
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
     * @ORM\OneToMany(targetEntity=League::class, mappedBy="defaultLeague")
     */
    private $leagues;

    /**
     * @ORM\OneToMany(targetEntity=DefaultTeam::class, mappedBy="defaultLeague")
     */
    private $defaultTeams;

    public function __construct()
    {
        $this->leagues = new ArrayCollection();
        $this->defaultTeams = new ArrayCollection();
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

    /**
     * @return Collection<int, League>
     */
    public function getLeagues(): Collection
    {
        return $this->leagues;
    }

    public function addLeague(League $league): self
    {
        if (!$this->leagues->contains($league)) {
            $this->leagues[] = $league;
            $league->setDefaultLeague($this);
        }

        return $this;
    }

    public function removeLeague(League $league): self
    {
        if ($this->leagues->removeElement($league)) {
            // set the owning side to null (unless already changed)
            if ($league->getDefaultLeague() === $this) {
                $league->setDefaultLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DefaultTeam>
     */
    public function getDefaultTeams(): Collection
    {
        return $this->defaultTeams;
    }

    public function addDefaultTeam(DefaultTeam $defaultTeam): self
    {
        if (!$this->defaultTeams->contains($defaultTeam)) {
            $this->defaultTeams[] = $defaultTeam;
            $defaultTeam->setDefaultLeague($this);
        }

        return $this;
    }

    public function removeDefaultTeam(DefaultTeam $defaultTeam): self
    {
        if ($this->defaultTeams->removeElement($defaultTeam)) {
            // set the owning side to null (unless already changed)
            if ($defaultTeam->getDefaultLeague() === $this) {
                $defaultTeam->setDefaultLeague(null);
            }
        }

        return $this;
    }
}
