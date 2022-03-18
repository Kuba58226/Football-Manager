<?php

namespace App\Service\Admin;

use App\Entity\DefaultTeam;
use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;

class LeagueCreator
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var TeamCloner $teamCloner
     */
    private $teamCloner;

    public function __construct(
        EntityManagerInterface $entityManager,
        TeamCloner $teamCloner
    ) {
        $this->entityManager = $entityManager;
        $this->teamCloner = $teamCloner;
    }

    public function __invoke(League $league)
    {
        $defaultTeams = $league->getDefaultLeague()->getDefaultTeams()->toArray();
        foreach ($defaultTeams as $defaultTeam) {
            $team = ($this->teamCloner)($defaultTeam, $league);

            $this->entityManager->persist($team);
            $this->entityManager->flush();
        }
    }
}