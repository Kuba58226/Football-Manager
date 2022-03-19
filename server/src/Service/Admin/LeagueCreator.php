<?php

namespace App\Service\Admin;

use App\Entity\DefaultPlayer;
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
     * @var TeamCreator $teamCreator
     */
    private $teamCreator;

    /**
     * @var PlayerCreator $playerCreator
     */
    private $playerCreator;

    public function __construct(
        EntityManagerInterface $entityManager,
        TeamCreator $teamCreator,
        PlayerCreator $playerCreator
    ) {
        $this->entityManager = $entityManager;
        $this->teamCreator = $teamCreator;
        $this->playerCreator = $playerCreator;
    }

    public function __invoke(League $league)
    {
        $defaultTeams = $league->getDefaultLeague()->getDefaultTeams();

        /** @var DefaultTeam $defaultTeam */
        foreach ($defaultTeams as $defaultTeam) {
            $team = ($this->teamCreator)($defaultTeam, $league);

            $defaultPlayers = $defaultTeam->getDefaultPlayers();

            /** @var DefaultPlayer $defaultPlayer */
            foreach ($defaultPlayers as $defaultPlayer) {
                $player = ($this->playerCreator)($defaultPlayer, $team);
                $this->entityManager->persist($player);
            }

            $this->entityManager->persist($team);
            $this->entityManager->flush();
        }
    }
}