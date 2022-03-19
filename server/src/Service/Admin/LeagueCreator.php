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

    /**
     * @var ScheduleGenerator $scheduleGenerator
     */
    private $scheduleGenerator;

    public function __construct(
        EntityManagerInterface $entityManager,
        TeamCreator $teamCreator,
        PlayerCreator $playerCreator,
        ScheduleGenerator $scheduleGenerator
    ) {
        $this->entityManager = $entityManager;
        $this->teamCreator = $teamCreator;
        $this->playerCreator = $playerCreator;
        $this->scheduleGenerator = $scheduleGenerator;
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

        ($this->scheduleGenerator)($league);
    }
}