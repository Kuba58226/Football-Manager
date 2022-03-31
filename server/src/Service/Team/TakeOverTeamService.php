<?php

namespace App\Service\Team;

use App\Entity\User;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class TakeOverTeamService
{
    public const USER_TEAM_LIMIT = 1;

    /**
     * @var TeamRepository $teamRepository
     */
    private $teamRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(
        TeamRepository $teamRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->teamRepository = $teamRepository;
        $this->entityManager = $entityManager;
    }

    public function __invoke(int $id, User $user)
    {
        $team = $this->teamRepository->find($id);

        if (!$team) {
            throw new Exception('Team not found');
        }

        if ($team->getUser()) {
            throw new Exception('Team already has an user');
        }

        if ($user->getTeams()->count() >= self::USER_TEAM_LIMIT) {
            throw new Exception('Teams limit exceeded');
        }

        $team->setUser($user);
        $user->addTeam($team);
        $this->entityManager->persist($team);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}