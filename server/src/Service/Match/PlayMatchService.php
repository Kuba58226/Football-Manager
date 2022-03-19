<?php

namespace App\Service\Match;

use App\Entity\MatchResult;
use App\Service\Admin\MatchResultCreator;
use Doctrine\ORM\EntityManagerInterface;

class PlayMatchService
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(MatchResult $matchResult)
    {
        $matchResult->setHomeTeamGoals(rand(0, 3));
        $matchResult->setAwayTeamGoals(rand(0, 3));
        $matchResult->setState(MatchResultCreator::PLAYED);

        $this->entityManager->persist($matchResult);
        $this->entityManager->flush();
    }
}