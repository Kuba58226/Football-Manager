<?php


namespace App\Service\Admin;

use App\Entity\League;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ScheduleGenerator
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var MatchResultCreator $matchResultCreator
     */
    private $matchResultCreator;

    public function __construct(
        EntityManagerInterface $entityManager,
        MatchResultCreator $matchResultCreator
    ) {
        $this->entityManager = $entityManager;
        $this->matchResultCreator = $matchResultCreator;
    }

    public function __invoke(League $league): void
    {
        $teamsArray = $league->getTeams()->toArray();
        $leagueSize = count($teamsArray);

        $this->generateRound($league, $teamsArray, $leagueSize);
    }

    private function generateRound(League $league, array $teamsArray, int $leagueSize): void
    {
        for ($i = 0; $i < $leagueSize - 1; $i++) {
            for ($j = 0; $j < $leagueSize / 2; $j++) {
                $matchResult = ($this->matchResultCreator)($league, $teamsArray[$j], $teamsArray[$j + ($leagueSize / 2)], new DateTime("now"), $i + 1);
                $this->entityManager->persist($matchResult);
            }
            $this->entityManager->flush();
            $lastTeam = array_pop($teamsArray);
            array_splice($teamsArray, 1, 0, [$lastTeam]);
        }
    }
}